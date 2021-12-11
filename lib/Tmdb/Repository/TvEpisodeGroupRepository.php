<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author sheriffmarley
 * @version 4.0.0
 */

namespace Tmdb\Repository;

use Tmdb\Api\TvEpisodeGroup;
use Tmdb\Model\AbstractModel;
use Tmdb\Exception\RuntimeException;
use Tmdb\Factory\TvEpisodeGroupFactory;
use Tmdb\Model\Tv\Episode\QueryParameter\AppendToResponse;

/**
 * Class TvEpisodeGroupRepository
 * @package Tmdb\Repository
 * @see http://docs.themoviedb.apiary.io/#tvepisodes
 */
class TvEpisodeGroupRepository extends AbstractRepository
{
    /**
     * Load a tv season with the given identifier
     *
     * If you want to optimize the result set/bandwidth you should
     * define the AppendToResponse parameter
     *
     * @param $episode_group_id string
     * @param $parameters
     * @param $headers
     * @return null|AbstractModel
     * @throws RuntimeException
     */
    public function load($episode_group_id, array $parameters = [], array $headers = [])
    {

        if (is_null($episode_group_id)) {
            throw new RuntimeException('Not all required parameters to load the episode group.');
        }

        if (!isset($parameters['append_to_response'])) {
            $parameters = array_merge($parameters, [
                new AppendToResponse([

                ])
            ]);
        }

        $data = $this->getApi()->getEpisodeGroup(
            $episode_group_id,
            $this->parseQueryParameters($parameters),
            $headers
        );

        return $this->getFactory()->create($data);
    }

    /**
     * Return the Seasons API Class
     *
     * @return TvEpisodeGroup
     */
    public function getApi()
    {
        return $this->getClient()->getTvEpisodeGroupApi();
    }

    /**
     * @return TvEpisodeGroupFactory
     */
    public function getFactory()
    {
        return new TvEpisodeGroupFactory($this->getClient()->getHttpClient());
    }
}
