<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 4.0.0
 */

namespace Tmdb\Factory;

use RuntimeException;
use Tmdb\Common\ObjectHydrator;
use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Event\HydrationEvent;
use Tmdb\Event\TmdbEvents;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Common\AccountStates;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\Rating;
use Tmdb\Model\Lists\Result;

/**
 * Class AbstractFactory
 * @package Tmdb\Factory
 */
abstract class AbstractFactory
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Convert an array to an hydrated object
     *
     * @param array $data
     * @return AbstractModel
     */
    abstract public function create(array $data = []);

    /**
     * Convert an array with an collection of items to an hydrated object collection
     *
     * @param array $data
     * @return GenericCollection
     */
    abstract public function createCollection(array $data = []);

    /**
     * Create a result collection
     *
     * @param array $data
     * @param string $method
     * @return ResultCollection
     */
    public function createResultCollection($data = [], $method = 'create')
    {
        $collection = new ResultCollection();

        if (null === $data) {
            return $collection;
        }

        if (array_key_exists('page', $data)) {
            $collection->setPage($data['page']);
        }

        if (array_key_exists('total_pages', $data)) {
            $collection->setTotalPages($data['total_pages']);
        }

        if (array_key_exists('total_results', $data)) {
            $collection->setTotalResults($data['total_results']);
        }

        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach ($data as $item) {
            $collection->add(null, $this->$method($item));
        }

        return $collection;
    }

    /**
     * Create rating
     *
     * @param array $data
     * @return AbstractModel
     */
    public function createRating(array $data = [])
    {
        return $this->hydrate(new Rating(), $data);
    }

    /**
     * Hydrate the object with data
     *
     * @param AbstractModel $subject
     * @param array $data
     * @return AbstractModel
     */
    protected function hydrate(AbstractModel $subject, $data = [])
    {
        $httpClient = $this->getHttpClient();
        $hydrationOptions = $this->getHttpClient()->getOptions('hydration');

        $eventListenerHandlesHydration = $hydrationOptions['event_listener_handles_hydration'];
        $eventBasedHydrationModels = $hydrationOptions['only_for_specified_models'];

        if (
            $eventListenerHandlesHydration && empty($eventBasedHydrationModels) || in_array(
                get_class($subject),
                $eventBasedHydrationModels
            )
        ) {
            $event = new HydrationEvent($subject, $data);
            $event->setLastRequest($httpClient->getLastRequest());
            $event->setLastResponse($httpClient->getLastResponse());

            $this->getHttpClient()->getEventDispatcher()->dispatch($event);

            return $event->getSubject();
        }

        // Still fire the before hydration event.
        $event = new BeforeHydrationEvent($subject, $data);
        $event->setLastRequest($httpClient->getLastRequest());
        $event->setLastResponse($httpClient->getLastResponse());

        $this->getHttpClient()->getEventDispatcher()->dispatch($event);

        return (new ObjectHydrator())->hydrate($subject, $data);
    }

    /**
     * Get the http client
     *
     * @return HttpClient
     */
    protected function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Create the account states
     *
     * @param array $data
     * @return AbstractModel
     */
    public function createAccountStates(array $data = [])
    {
        $accountStates = new AccountStates();

        if (array_key_exists('rated', $data)) {
            if ($data['rated']) {
                $rating = new Rating();

                $accountStates->setRated($this->hydrate($rating, $data['rated']));
            } else {
                $accountStates->setRated(false);
            }
        }

        return $this->hydrate($accountStates, $data);
    }

    /**
     * Create result
     *
     * @param array $data
     * @return AbstractModel
     */
    public function createResult(array $data = [])
    {
        return $this->hydrate(new Result(), $data);
    }

    /**
     * Create a generic collection of data and map it on the class by it's static parameter $properties
     *
     * @param array $data
     * @param AbstractModel $class
     *
     * @return GenericCollection
     */
    protected function createGenericCollection(array $data = [], AbstractModel $class = null): GenericCollection
    {
        if (!$class) {
            throw new \Tmdb\Exception\RuntimeException('Expected a class to be present.');
        }

        if (is_object($class)) {
            $class = get_class($class);
        }

        $collection = new GenericCollection();

        if (null === $data) {
            return $collection;
        }

        foreach ($data as $item) {
            $collection->add(null, $this->hydrate(new $class(), $item));
        }

        return $collection;
    }

    /**
     * Create a generic collection of data and map it on the class by it's static parameter $properties
     *
     * @param array $data
     * @param AbstractModel $class
     * @param GenericCollection $collection
     * @return GenericCollection
     */
    protected function createCustomCollection(
        array $data = [],
        AbstractModel $class = null,
        GenericCollection $collection
    ) {
        if (!$class || !$collection) {
            throw new \Tmdb\Exception\RuntimeException('Expected both an class and collection to be given.');
        }

        if (is_object($class)) {
            $class = get_class($class);
        }

        if (null === $data) {
            return $collection;
        }

        foreach ($data as $item) {
            $collection->add(null, $this->hydrate(new $class(), $item));
        }

        return $collection;
    }

    /**
     * Create an generic collection of an array that consists out of a mix of movies and tv shows
     *
     * @param array $data
     * @return GenericCollection
     */
    protected function createGenericCollectionFromMediaTypes($data = [])
    {
        $movieFactory = new MovieFactory($this->getHttpClient());
        $tvFactory = new TvFactory($this->getHttpClient());
        $collection = new GenericCollection();

        foreach ($data as $item) {
            switch ($item['media_type']) {
                case "movie":
                    $collection->add(null, $movieFactory->create($item));
                    break;

                case "tv":
                    $collection->add(null, $tvFactory->create($item));
                    break;

                default:
                    throw new RuntimeException('Unknown media type "%s"', $item['media_type']);
            }
        }

        return $collection;
    }
}
