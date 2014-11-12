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

/**
 * Class TvEpisode
 * @package Tmdb\Api
 * @see http://docs.themoviedb.apiary.io/#tvepisodes
 */
class TvEpisode extends AbstractApi
{
    /**
     * Get the primary information about a TV episode by combination of a season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getEpisode(
        $tvshow_id,
        $season_number,
        $episode_number,
        array $parameters = [],
        array $headers = []
    ) {
        return $this->get(
            sprintf(
                'tv/%s/season/%s/episode/%s',
                $tvshow_id,
                $season_number,
                $episode_number
            ),
            $parameters,
            $headers
        );
    }

    /**
     * Get the TV episode credits by combination of season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getCredits(
        $tvshow_id,
        $season_number,
        $episode_number,
        array $parameters = [],
        array $headers = []
    ) {
        return $this->get(
            sprintf(
                'tv/%s/season/%s/episode/%s/credits',
                $tvshow_id,
                $season_number,
                $episode_number
            ),
            $parameters,
            $headers
        );
    }

    /**
     * Get the external ids for a TV episode by comabination of a season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getExternalIds(
        $tvshow_id,
        $season_number,
        $episode_number,
        array $parameters = [],
        array $headers = []
    ) {
        return $this->get(
            sprintf(
                'tv/%s/season/%s/episode/%s/external_ids',
                $tvshow_id,
                $season_number,
                $episode_number
            ),
            $parameters,
            $headers
        );
    }

    /**
     * Get the images (episode stills) for a TV episode by combination of a season and episode number.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getImages(
        $tvshow_id,
        $season_number,
        $episode_number,
        array $parameters = [],
        array $headers = []
    ) {
        return $this->get(
            sprintf(
                'tv/%s/season/%s/episode/%s/images',
                $tvshow_id,
                $season_number,
                $episode_number
            ),
            $parameters,
            $headers
        );
    }

    /**
     * Get the videos that have been added to a TV episode (teasers, clips, etc...)
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getVideos(
        $tvshow_id,
        $season_number,
        $episode_number,
        array $parameters = [],
        array $headers = []
    ) {
        return $this->get(
            sprintf(
                'tv/%s/season/%s/episode/%s/videos',
                $tvshow_id,
                $season_number,
                $episode_number
            ),
            $parameters,
            $headers
        );
    }

    /**
     * Look up a TV episode's changes by episode ID.
     *
     * This method is used in conjunction with the /tv/{id}/changes method.
     * This method uses the episode_id value found in the change entries.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getChanges(
        $tvshow_id,
        $season_number,
        $episode_number,
        array $parameters = [],
        array $headers = []
    ) {
        return $this->get(
            sprintf(
                'tv/%s/season/%s/episode/%s/changes',
                $tvshow_id,
                $season_number,
                $episode_number
            ),
            $parameters,
            $headers
        );
    }

    /**
     * This method lets users get the status of whether or not the TV episode has been rated.
     *
     * A valid session id is required.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     *
     * @return mixed
     */
    public function getAccountStates(
        $tvshow_id,
        $season_number,
        $episode_number
    ) {
        return $this->get(
            sprintf(
                'tv/%s/season/%s/episode/%s/account_states',
                $tvshow_id,
                $season_number,
                $episode_number
            )
        );
    }

    /**
     * This method lets users rate a TV episode.
     *
     * A valid session id or guest session id is required.
     *
     * @param $tvshow_id
     * @param $season_number
     * @param $episode_number
     * @param double $rating
     *
     * @return mixed
     */
    public function rateTvEpisode(
        $tvshow_id,
        $season_number,
        $episode_number,
        $rating
    ) {
        return $this->postJson(
            sprintf(
                'tv/%s/season/%s/episode/%s/rating',
                $tvshow_id,
                $season_number,
                $episode_number
            ),
            ['value' => (float) $rating]
        );
    }

}
