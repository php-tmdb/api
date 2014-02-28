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
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('genre/list')
            ->will($this->returnValue(array('genres')))
        ; // there is no "selective" call, we always lean on the full list

        $api->getGenre(self::GENRE_ID);
    }

    /**
     * @test
     */
    public function shouldGetGenres()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('genre/list');

        $api->getGenres();
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('genre/' . self::GENRE_ID. '/movies');

        $api->getMovies(self::GENRE_ID);
    }

    /**
     * @test
     */
    public function shouldGetGenreAndReturnOne()
    {
        $api = $this->getApiMock(array('getGenres'));

        $api->expects($this->once())
            ->method('getGenres')
            ->will($this->returnCallback(function () {
                return array('genres' => array(array('id' => 28, 'name' => 'Action')));
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
        $api = $this->getApiMock(array('getGenres'));

        $api->expects($this->once())
            ->method('getGenres')
            ->will($this->returnCallback(function () {
                return array('genres' => array());
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
