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

class GenresTest extends TestCase
{
    public const GENRE_ID = 28;

    /**
     * @todo
     */
    public function shouldGetGenre()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $responseMock = $response = $this->createMock('Psr\Http\Message\ResponseInterface');
        $this->getPsr18Client()->setDefaultResponse();

        $this->getPsr18Client()->expects($this->at(0))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/movie/list'))
            ->will($this->returnValue(['genres']));

        $this->getPsr18Client()->expects($this->at(1))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/tv/list'))
            ->will($this->returnValue(['genres']));

        $api->getGenre(self::GENRE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/genre/tv/list');
    }

    /**
     * @todo
     */
    public function shouldGetGenres()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getPsr18Client()->expects($this->at(0))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/movie/list'));

        $this->getPsr18Client()->expects($this->at(1))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/tv/list'));

        $api->getGenres();
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
