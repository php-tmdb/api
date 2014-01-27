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
namespace Tmdb\Tests\Repository;

class TvEpisodeRepositoryTest extends TestCase
{
    const TV_ID      = 3572;
    const SEASON_ID  = 1;
    const EPISODE_ID = 1;

    /**
     * @test
     */
    public function shouldLoadTvEpisode()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->load(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\TvEpisode';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\TvEpisodeRepository';
    }
}