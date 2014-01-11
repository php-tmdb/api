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

class Tv
    extends AbstractApi
{
    /**
     * Get the primary information about a TV series by id.
     *
     * @param $tvshow_id
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getTvshow($tvshow_id, array $options = array(), array $headers = array())
    {
        return $this->get('tv/' . $tvshow_id, $options, $headers);
    }

    /**
     * Get the cast & crew information about a TV series. Just like the website, we pull this information from the last season of the series.
     *
     * @param $tvshow_id
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getCredits($tvshow_id, array $options = array(), array $headers = array())
    {
        return $this->get('tv/' . $tvshow_id . '/credits', $options, $headers);
    }

    /**
     * Get the external ids that we have stored for a TV series.
     *
     * @param $tvshow_id
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getCast($tvshow_id, array $options = array(), array $headers = array())
    {
        return $this->get('tv/' . $tvshow_id . '/external_ids', $options, $headers);
    }

    /**
     * Get the images (posters and backdrops) for a TV series.
     *
     * @param $tvshow_id
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getImages($tvshow_id, array $options = array(), array $headers = array())
    {
        return $this->get('tv/' . $tvshow_id . '/images', $options, $headers);
    }
}