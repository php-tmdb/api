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

use Tmdb\Exception\NotImplementedException;

class Tv
    extends AbstractApi
{
    /**
     * Get the primary information about a TV series by id.
     *
     * @param $tvshow_id
     * @param array $options
     * @return mixed
     */
    public function getTvshow($tvshow_id, array $options = array())
    {
        return $this->get('tv/' . $tvshow_id, $options);
    }

    /**
     * Get the cast & crew information about a TV series. Just like the website, we pull this information from the last season of the series.
     *
     * @param $tvshow_id
     * @param array $options
     * @return mixed
     */
    public function getCredits($tvshow_id, array $options = array())
    {
        return $this->get('tv/' . $tvshow_id . '/credits', $options);
    }

    /**
     * Get the external ids that we have stored for a TV series.
     *
     * @param $tvshow_id
     * @param array $options
     * @return mixed
     */
    public function getCast($tvshow_id, array $options = array())
    {
        return $this->get('tv/' . $tvshow_id . '/external_ids', $options);
    }

    /**
     * Get the images (posters and backdrops) for a TV series.
     *
     * @param $tvshow_id
     * @param array $options
     * @return mixed
     */
    public function getImages($tvshow_id, array $options = array())
    {
        return $this->get('tv/' . $tvshow_id . '/images', $options);
    }

    /**
     * Get the primary information about a TV season by its season number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param array $options
     * @return mixed
     */
    public function getSeason($tvshow_id, $season_number, array $options = array())
    {
        return $this->get(sprintf('tv/%s/season/%s', $tvshow_id, $season_number), $options);
    }

    /**
     * Get the external ids that we have stored for a TV season by season number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param array $options
     * @return mixed
     */
    public function getSeasonExternalIds($tvshow_id, $season_number, array $options = array())
    {
        return $this->get(sprintf('tv/%s/season/%s/external_ids', $tvshow_id, $season_number), $options);
    }

    /**
     * Get the primary information about a TV episode by combination of a season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param array $options
     * @return mixed
     */
    public function getEpisode($tvshow_id, $season_number, $episode_number, array $options = array())
    {
        return $this->get(sprintf('tv/%s/season/%s/episode/%s', $tvshow_id, $season_number,$episode_number), $options);
    }

    /**
     * Get the TV episode credits by combination of season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param array $options
     * @return mixed
     */
    public function getEpisodeCredits($tvshow_id, $season_number, $episode_number, array $options = array())
    {
        return $this->get(sprintf('tv/%s/season/%s/episode/%s/credits', $tvshow_id, $season_number,$episode_number), $options);
    }

    /**
     * Get the external ids for a TV episode by comabination of a season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param array $options
     * @return mixed
     */
    public function getEpisodeExternalIds($tvshow_id, $season_number, $episode_number, array $options = array())
    {
        return $this->get(sprintf('tv/%s/season/%s/episode/%s/external_ids', $tvshow_id, $season_number,$episode_number), $options);
    }

    /**
     * Get the images (episode stills) for a TV episode by combination of a season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param array $options
     * @return mixed
     */
    public function getEpisodeImages($tvshow_id, $season_number, $episode_number, array $options = array())
    {
        return $this->get(sprintf('tv/%s/season/%s/episode/%s/images', $tvshow_id, $season_number,$episode_number), $options);
    }
}