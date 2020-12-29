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

namespace Tmdb\Repository;

use Tmdb\Api\People;
use Tmdb\Factory\ImageFactory;
use Tmdb\Factory\PeopleFactory;
use Tmdb\Model\Collection\CreditsCollection\CombinedCredits;
use Tmdb\Model\Collection\CreditsCollection\MovieCredits;
use Tmdb\Model\Collection\CreditsCollection\TvCredits;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Person;
use Tmdb\Model\Person\QueryParameter\AppendToResponse;

/**
 * Class PeopleRepository
 * @package Tmdb\Repository
 * @see http://docs.themoviedb.apiary.io/#people
 *
 */
class PeopleRepository extends AbstractRepository
{
    /**
     * Load a person with the given identifier
     *
     * @param $id
     * @param array $parameters
     * @param array $headers
     * @return Person
     */
    public function load($id, array $parameters = [], array $headers = [])
    {
        if (!isset($parameters['append_to_response'])) {
            // Load a no-nonsense default set
            $parameters = array_merge($parameters, [
                new AppendToResponse([
                    AppendToResponse::IMAGES,
                    AppendToResponse::CHANGES,
                    AppendToResponse::COMBINED_CREDITS,
                    AppendToResponse::MOVIE_CREDITS,
                    AppendToResponse::TV_CREDITS,
                    AppendToResponse::EXTERNAL_IDS,
                    AppendToResponse::TAGGED_IMAGES
                ])
            ]);
        }

        $data = $this->getApi()->getPerson($id, $this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->create($data);
    }

    /**
     * Return the related API class
     *
     * @return People
     */
    public function getApi()
    {
        return $this->getClient()->getPeopleApi();
    }

    /**
     * @return PeopleFactory
     */
    public function getFactory()
    {
        return new PeopleFactory($this->getClient()->getHttpClient());
    }

    /**
     * Get the movie credits for a specific person id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return MovieCredits
     */
    public function getMovieCredits($id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getMovieCredits($id, $this->parseQueryParameters($parameters), $headers);
        $person = $this->getFactory()->create(['movie_credits' => $data]);

        return $person->getMovieCredits();
    }

    /**
     * Get the TV credits for a specific person id.
     *
     * To get the expanded details for each record,
     * call the /credit method with the provided credit_id.
     *
     * This will provide details about which episode and/or season the credit is for.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return TvCredits
     */
    public function getTvCredits($id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getTvCredits($id, $this->parseQueryParameters($parameters), $headers);
        $person = $this->getFactory()->create(['tv_credits' => $data]);

        return $person->getTvCredits();
    }

    /**
     * Get the combined (movie and TV) credits for a specific person id.
     *
     * To get the expanded details for each TV record,
     * call the /credit method with the provided credit_id.
     *
     * This will provide details about which episode and/or season the credit is for.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return CombinedCredits
     */
    public function getCombinedCredits($id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getCombinedCredits($id, $this->parseQueryParameters($parameters), $headers);
        $person = $this->getFactory()->create(['combined_credits' => $data]);

        return $person->getCombinedCredits();
    }

    /**
     * Get the external ids for a specific person id.
     *
     * @param $id
     * @return ExternalIds
     */
    public function getExternalIds($id)
    {
        $data = $this->getApi()->getExternalIds($id);
        $person = $this->getFactory()->create(['external_ids' => $data]);

        return $person->getExternalIds();
    }

    /**
     * Get the images for a specific person id.
     *
     * @param $id
     * @return Images
     */
    public function getImages($id)
    {
        $data = $this->getApi()->getImages($id);
        $person = $this->getFactory()->create(['images' => $data]);

        return $person->getImages();
    }

    /**
     * Get the changes for a specific person id.
     *
     * Changes are grouped by key, and ordered by date in descending order.
     *
     * By default, only the last 24 hours of changes are returned.
     * The maximum number of days that can be returned in a single request is 14.
     * The language is present on fields that are translatable.
     *
     * @param $id
     * @param array $parameters
     * @param array $headers
     * @return GenericCollection
     */
    public function getChanges($id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getChanges($id, $this->parseQueryParameters($parameters), $headers);
        $person = $this->getFactory()->create(['changes' => $data]);

        return $person->getChanges();
    }

    /**
     * Get the changes for a specific person id.
     *
     * Changes are grouped by key, and ordered by date in descending order.
     *
     * By default, only the last 24 hours of changes are returned.
     * The maximum number of days that can be returned in a single request is 14.
     * The language is present on fields that are translatable.
     *
     * @param $id
     * @param array $parameters
     * @param array $headers
     * @return ResultCollection
     */
    public function getTaggedImages($id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getTaggedImages($id, $this->parseQueryParameters($parameters), $headers);

        $factory = new ImageFactory($this->getClient()->getHttpClient());

        return $factory->createResultCollection($data, 'createMediaImage');
    }

    /**
     * Get the list of popular people on The Movie Database.
     *
     * This list refreshes every day.
     *
     * @param array $parameters
     * @param array $headers
     * @return ResultCollection
     */
    public function getPopular(array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getPopular($parameters, $headers);

        return $this->getFactory()->createResultCollection($data);
    }

    /**
     * Get the latest person id.
     *
     * @return Person
     */
    public function getLatest()
    {
        $data = $this->getApi()->getLatest();

        return $this->getFactory()->create($data);
    }
}
