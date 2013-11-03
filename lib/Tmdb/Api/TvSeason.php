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

class TvSeason
    extends AbstractApi
{
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
}