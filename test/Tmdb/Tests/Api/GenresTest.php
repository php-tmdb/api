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
namespace Tmdb\Tests\Api;

class GenresTest extends TestCase
{
    const GENRE_ID = 28;

    /**
     * @test
     */
    public function shouldGetGenre()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->at(0))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/movie/list'))
            ->will($this->returnValue(['genres']))
        ;

        $this->getAdapter()->expects($this->at(1))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/tv/list'))
            ->will($this->returnValue(['genres']))
        ; // there is no "selective" call, we always lean on both lists

        $api->getGenre(self::GENRE_ID);
    }

    /**
     * @test
     */
    public function shouldGetGenres()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->at(0))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/movie/list'));

        $this->getAdapter()->expects($this->at(1))
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

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/movie/list'));

        $api->getMovieGenres();
    }

    /**
     * @test
     */
    public function shouldGetTvGenres()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/tv/list'));

        $api->getTvGenres();
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/' . self::GENRE_ID. '/movies'));

        $api->getMovies(self::GENRE_ID);
    }

    /**
     * @test
     */
    public function shouldGetGenreAndReturnOne()
    {
        $api = $this->getMockedApi(['getGenres']);

        $api->expects($this->once())
            ->method('getGenres')
            ->will($this->returnCallback(function () {
                return ['genres' => [['id' => 28, 'name' => 'Action']]];
            }))
        ;

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
            ->will($this->returnCallback(function () {
                return ['genres' => []];
            }))
        ;

        $genre = $api->getGenre(self::GENRE_ID);

        $this->assertEquals(null, $genre);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Genres';
    }
}
