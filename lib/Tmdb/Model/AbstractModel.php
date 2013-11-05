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
 * @version 0.0.1
 */
namespace Tmdb\Model;

use Tmdb\Client;
use Tmdb\Exception\RuntimeException;

use Tmdb\Model\Collection\Credits\Cast;
use Tmdb\Model\Collection\Credits\Crew;
use Tmdb\Model\Collection\Genres;
use Tmdb\Model\Collection\People;

use Tmdb\Model\Common\Collection\Images;

use Tmdb\Model\Common\Collection;
use Tmdb\Model\Common\QueryParameter\QueryParameterInterface;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\CrewMember;

class AbstractModel {
    protected static $_properties;

    protected $_data = array();
    protected $_client = null;

    /**
     * Retrieve the client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * Set the client
     *
     * @param Client $client
     * @return $this
     */
    public function setClient(Client $client = null)
    {
        if (null !== $client) {
            $this->_client = $client;
        }

        return $this;
    }

    /**
     * Call a part of the API
     *
     * @param $api
     * @return mixed
     */
    public function api($api)
    {
        return $this->getClient()->api($api);
    }

    /**
     * Hydrate the object with data
     *
     * @param array $data
     * @return $this
     * @throws \Tmdb\Exception\RuntimeException
     */
    public function hydrate(array $data = array())
    {
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                if (in_array($k, static::$_properties)) {

                    $method = $this->camelize(
                        sprintf('set_%s', $k)
                    );

                    if (!method_exists($this, $method)) {
                        throw new RuntimeException(sprintf(
                            'Trying to call method "%s" on "%s" but it does not exist or is private.',
                            $method,
                            get_class($this)
                        ));
                    }

                    $this->$method($v);
                }
            }
        }

        return $this;
    }

    /**
     * Process query parameters
     *
     * @param array $parameters
     * @return array
     */
    protected function parseQueryParameters(array $parameters = array())
    {
        foreach($parameters as $key => $candidate) {
            if ($candidate instanceof QueryParameterInterface) {
                unset($parameters[$key]);

                $parameters[$candidate->getKey()] = $candidate->getValue();
            }
        }

        return $parameters;
    }

    /**
     * Collect all images from an `image` array ( containing e.g. posters / profiles etc. )
     *
     * @param $client
     * @param array $collection
     * @return Image[]
     */
    protected function collectImages($client, array $collection = array())
    {
        $images = new Images();

        foreach($collection as $collectionName => $itemCollection) {
            foreach($itemCollection as $item) {
                if (!is_array($item)) {
                    continue;
                }

                $image = Image::fromArray($client, $item);

                $image->setType(Image::getTypeFromCollectionName($collectionName));

                $images->addImage($image);
            }
        }

        return $images;
    }

    /**
     * Collect all people from an array
     *
     * @param $client
     * @param array $collection
     * @return Person[]
     */
    protected function collectPeople($client, array $collection = array())
    {
        $people = new People();

        foreach($collection as $item) {
            $person = Person::fromArray($client, $item);

            $people->addPerson($person);
        }

        return $people;
    }

    /**
     * Collect cast
     *
     * @param $client
     * @param array $collection
     * @return CastMember[]
     */
    protected function collectCast($client, array $collection = array())
    {
        $people = new Cast();

        foreach($collection as $item) {
            $person = CastMember::fromArray($client, $item);

            $people->addPerson($person);
        }

        return $people;
    }

    /**
     * Collect crew
     *
     * @param $client
     * @param array $collection
     * @return CrewMember[]
     */
    protected function collectCrew($client, array $collection = array())
    {
        $people = new Crew();

        foreach($collection as $item) {
            $person = CrewMember::fromArray($client, $item);

            $people->addPerson($person);
        }

        return $people;
    }

    /**
     * Collect all genres from an array
     *
     * @param $client
     * @param array $collection
     * @return Genre[]
     */
    protected function collectGenres($client, array $collection = array())
    {
        $genres = new Genres();

        foreach($collection as $item) {
            $genre = Genre::fromArray($client, $item);
            $genres->addGenre($genre);
        }

        return $genres;
    }

    /**
     * Collect all genres from an array
     *
     * @param $client
     * @param array $collection
     * @param object $object
     * @return Collection
     */
    protected function collectGenericCollection($client, array $collection = array(), $object)
    {
        $collectionObject = new Collection();

        foreach($collection as $item) {
            $class = get_class($object);
            $model = $class::fromArray($client, $item);

            $collectionObject->addObject($model);
        }

        return $collectionObject;
    }

    /**
     * Transforms an under_scored_string to a camelCasedOne
     *
     * @see https://gist.github.com/troelskn/751517
     *
     * @param $candidate
     * @return string
     */
    private function camelize($candidate)
    {
        return lcfirst(
            implode('',
                array_map('ucfirst',
                    array_map('strtolower',
                        explode('_', $candidate
                        )
                    )
                )
            )
        );
    }

    /**
     * Transforms a camelCasedString to an under_scored_one
     *
     * @see https://gist.github.com/troelskn/751517
     *
     * @param $camelized
     * @return string
     */
    private function uncamelize($camelized) {
        return implode('_',
            array_map('strtolower',
                preg_split('/([A-Z]{1}[^A-Z]*)/', $camelized, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY)
            )
        );
    }

}