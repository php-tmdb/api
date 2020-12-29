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

class ChangesTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetMovieChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getMovieChanges();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/changes');
    }

    /**
     * @test
     */
    public function shouldGetPersonChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getPersonChanges();
        $this->assertLastRequestIsWithPathAndMethod('/3/person/changes');
    }

    /**
     * @test
     */
    public function shouldGetTvChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTvChanges();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/changes');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Changes';
    }
}
