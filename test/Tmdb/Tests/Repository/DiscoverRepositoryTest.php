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
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/discover/movie', []))
        ;

        $query = new DiscoverMoviesQuery();

        $repository->discoverMovies($query);
    }

    /**
     * @test
     * @expectedException Tmdb\Exception\RuntimeException
     */
    public function shouldThrowExceptionWhenCertificationCountryIssetButCertificationLteIsNot()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $query = new DiscoverMoviesQuery();
        $query->certificationCountry('nl');

        $repository->discoverMovies($query);
    }

    /**
     * @test
     * @expectedException Tmdb\Exception\NotImplementedException
     */
    public function shouldThrowExceptionForGetFactory()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getFactory();
    }

    /**
     * @test
     */
    public function shouldDiscoverTv()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/discover/tv', []))
        ;

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
