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

use Psr\Http\Message\RequestInterface;

class GenreRepositoryTest extends TestCase
{
    public const GENRE_ID = 28;

    /**
     * @test
     */
    public function shouldLoadGenre()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->load(self::GENRE_ID);

        $requests = $this->getPsr18Client()->getRequests();

        /** @var RequestInterface $reqOne */
        $reqOne = array_shift($requests);

        /** @var RequestInterface $reqTwo */
        $reqTwo = array_shift($requests);

        $this->assertEquals('/3/genre/movie/list', $reqOne->getUri()->getPath());
        $this->assertEquals('/3/genre/tv/list', $reqTwo->getUri()->getPath());
    }

    /**
     * @test
     */
    public function shouldLoadCollection()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->loadCollection();

        $requests = $this->getPsr18Client()->getRequests();

        /** @var RequestInterface $reqOne */
        $reqOne = array_shift($requests);

        /** @var RequestInterface $reqTwo */
        $reqTwo = array_shift($requests);

        $this->assertEquals('/3/genre/movie/list', $reqOne->getUri()->getPath());
        $this->assertEquals('/3/genre/tv/list', $reqTwo->getUri()->getPath());
    }

    /**
     * @test
     */
    public function shouldLoadMovieCollection()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->loadMovieCollection();
        $this->assertLastRequestIsWithPathAndMethod('/3/genre/movie/list');
    }

    /**
     * @test
     */
    public function shouldLoadTvCollection()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->loadTvCollection();
        $this->assertLastRequestIsWithPathAndMethod('/3/genre/tv/list');
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getMovies(self::GENRE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/genre/' . self::GENRE_ID . '/movies');
    }

    /**
     * @test
     */
    public function shouldGetFactory()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $this->assertInstanceOf('Tmdb\Factory\GenreFactory', $repository->getFactory());
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Genres';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\GenreRepository';
    }
}
