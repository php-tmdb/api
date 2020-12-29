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
 * @version 4.0.0
 */

namespace Tmdb\Tests\Repository;

use Tmdb\Exception\NotImplementedException;
use Tmdb\Exception\RuntimeException;
use Tmdb\Model\Query\Discover\DiscoverMoviesQuery;
use Tmdb\Model\Query\Discover\DiscoverTvQuery;

class DiscoverRepositoryTest extends TestCase
{

    /**
     * @test
     */
    public function shouldDiscoverMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $query = new DiscoverMoviesQuery();

        $repository->discoverMovies($query);
        $this->assertLastRequestIsWithPathAndMethod('/3/discover/movie');
    }

    /**
     * @test
     *
     */
    public function shouldThrowExceptionWhenCertificationCountryIssetButCertificationLteIsNot()
    {
        $this->expectException(RuntimeException::class);
        $repository = $this->getRepositoryWithMockedHttpClient();

        $query = new DiscoverMoviesQuery();
        $query->certificationCountry('nl');

        $repository->discoverMovies($query);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionForGetFactory()
    {
        $this->expectException(NotImplementedException::class);
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getFactory();
    }

    /**
     * @test
     */
    public function shouldDiscoverTv()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $query = new DiscoverTvQuery();

        $repository->discoverTv($query);
        $this->assertLastRequestIsWithPathAndMethod('/3/discover/tv');
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
