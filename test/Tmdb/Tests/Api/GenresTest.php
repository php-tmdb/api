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

namespace Tmdb\Tests\Api;

use Psr\Http\Message\RequestInterface;

class GenresTest extends TestCase
{
    public const GENRE_ID = 28;

    /**
     * @test
     */
    public function shouldGetGenre()
    {
        $api = $this->getApiWithMockedHttpAdapter();
        $api->getGenre(self::GENRE_ID);

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
    public function shouldGetGenres()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getGenres();

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
    public function shouldGetMovieGenres()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getMovieGenres();
        $this->assertLastRequestIsWithPathAndMethod('/3/genre/movie/list');
    }

    /**
     * @test
     */
    public function shouldGetTvGenres()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTvGenres();
        $this->assertLastRequestIsWithPathAndMethod('/3/genre/tv/list');
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getMovies(self::GENRE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/genre/' . self::GENRE_ID . '/movies');
    }

    /**
     * @test
     */
    public function shouldGetGenreAndReturnOne()
    {
        $api = $this->getMockedApi(['getGenres']);

        $api->expects($this->once())
            ->method('getGenres')
            ->will(
                $this->returnCallback(
                    function () {
                        return ['genres' => [['id' => 28, 'name' => 'Action']]];
                    }
                )
            );

        $genre = $api->getGenre(self::GENRE_ID);

        $this->assertEquals(28, $genre['id']);
        $this->assertEquals('Action', $genre['name']);
    }

    /**
     * @test
     */
    public function shouldReturnNullWithNoData()
    {
        $api = $this->getMockedApi(['getGenres']);

        $api->expects($this->once())
            ->method('getGenres')
            ->will(
                $this->returnCallback(
                    function () {
                        return ['genres' => []];
                    }
                )
            );

        $genre = $api->getGenre(self::GENRE_ID);

        $this->assertEquals(null, $genre);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Genres';
    }
}
