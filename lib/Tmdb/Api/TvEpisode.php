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

class TvEpisode
    extends AbstractApi
{
    /**
     * Get the primary information about a TV episode by combination of a season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getEpisode($tvshow_id, $season_number, $episode_number, array $options = array(), array $headers = array())
    {
        return $this->get(sprintf('tv/%s/season/%s/episode/%s', $tvshow_id, $season_number,$episode_number), $options, $headers);
    }

    /**
     * Get the TV episode credits by combination of season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getEpisodeCredits($tvshow_id, $season_number, $episode_number, array $options = array(), array $headers = array())
    {
        return $this->get(sprintf('tv/%s/season/%s/episode/%s/credits', $tvshow_id, $season_number,$episode_number), $options, $headers);
    }

    /**
     * Get the external ids for a TV episode by comabination of a season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getEpisodeExternalIds($tvshow_id, $season_number, $episode_number, array $options = array(), array $headers = array())
    {
        return $this->get(sprintf('tv/%s/season/%s/episode/%s/external_ids', $tvshow_id, $season_number,$episode_number), $options, $headers);
    }

    /**
     * Get the images (episode stills) for a TV episode by combination of a season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getEpisodeImages($tvshow_id, $season_number, $episode_number, array $options = array(), array $headers = array())
    {
        return $this->get(sprintf('tv/%s/season/%s/episode/%s/images', $tvshow_id, $season_number,$episode_number), $options, $headers);
    }
}
