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

use Tmdb\Model\Query\Discover\DiscoverMoviesQuery;
use Tmdb\Model\Query\Discover\DiscoverTvQuery;

class DiscoverRepositoryTest extends TestCase
{

    /**
     * @test
     */
    public function shouldDiscoverMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $query = new DiscoverMoviesQuery();

        $repository->discoverMovies($query);
    }

    /**
     * @test
     */
    public function shouldDiscoverTv()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $query = new DiscoverTvQuery();

        $repository->discoverTv($query);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Discover';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\DiscoverRepository';
    }
}