<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author sheriffmarley
 * @copyright (c) 2013, Michael Roterman
 * @version 4.0.0
 */

namespace Tmdb\Api;

/**
 * Class TvEpisode
 * @package Tmdb\Api
 * @see http://docs.themoviedb.apiary.io/#tvepisodes
 */
class TvEpisodeGroup extends AbstractApi
{
    /**
     * Get the primary information about a TV episode group by it's id.
     *
     * @param $episode_group
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function getEpisodeGroup(
        $episode_group,
        array $parameters = [],
        array $headers = []
    ) {
        return $this->get(
            sprintf(
                'tv/episode_group/%s',
                $episode_group
            ),
            $parameters,
            $headers
        );
    }
}
