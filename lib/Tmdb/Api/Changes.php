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

class Changes
    extends AbstractApi
{
    /**
     * Get a list of movie ids that have been edited.
     *
     * By default we show the last 24 hours and only 100 items per page.
     * The maximum number of days that can be returned in a single request is 14.
     *
     * You can then use the movie changes API to get the actual data that has been changed.
     *
     * Please note that the change log system to support this was changed
     * on October 5, 2012 and will only show movies that have been edited since.
     *
     * @param array $options
     * @return mixed
     */
    public function getMovieChanges(array $options = array())
    {
        return $this->get('movie/changes', $options);
    }

    /**
     * Get a list of people ids that have been edited.
     *
     * By default we show the last 24 hours and only 100 items per page.
     * The maximum number of days that can be returned in a single request is 14.
     *
     * You can then use the movie changes API to get the actual data that has been changed.
     *
     * Please note that the change log system to support this was changed
     * on October 5, 2012 and will only show movies that have been edited since.
     *
     * @param array $options
     * @return mixed
     */
    public function getPeopleChanges(array $options = array())
    {
        return $this->get('person/changes', $options);
    }
}