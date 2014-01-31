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
namespace Tmdb\Api;

class People
    extends AbstractApi
{
    /**
     * Get the general person information for a specific id.
     *
     * @param $person_id
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function getPerson($person_id, array $parameters = array(), array $headers = array())
    {
        return $this->get('person/' . $person_id, $parameters, $headers);
    }

    /**
     * Get the credits for a specific person id.
     *
     * @param $person_id
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function getCredits($person_id, array $parameters = array(), array $headers = array())
    {
        return $this->get('person/' . $person_id . '/credits', $parameters, $headers);
    }

    /**
     * Get the images for a specific person id.
     *
     * @param $person_id
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function getImages($person_id, array $parameters = array(), array $headers = array())
    {
        return $this->get('person/' . $person_id . '/images', $parameters, $headers);
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
     * @param $person_id
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function getChanges($person_id, array $parameters = array(), array $headers = array())
    {
        return $this->get('person/' . $person_id . '/changes', $parameters, $headers);
    }

    /**
     * Get the list of popular people on The Movie Database. This list refreshes every day.
     *
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function getPopular(array $parameters = array(), array $headers = array())
    {
        return $this->get('person/popular', $parameters, $headers);
    }

    /**
     * Get the latest person id.
     *
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function getLatest(array $parameters = array(), array $headers = array())
    {
        return $this->get('person/latest', $parameters, $headers);
    }
}
