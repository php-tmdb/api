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

class ChangesTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetMovieChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/changes'));

        $api->getMovieChanges();
    }

    /**
     * @test
     */
    public function shouldGetPersonChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/person/changes'));

        $api->getPersonChanges();
    }

    /**
     * @test
     */
    public function shouldGetTvChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/changes'));

        $api->getTvChanges();
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Changes';
    }
}
