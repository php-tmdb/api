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

class DiscoverTest extends TestCase
{
    /**
     * @test
     */
    public function shouldDiscoverMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->discoverMovies();
        $this->assertLastRequestIsWithPathAndMethod('/3/discover/movie');
    }

    /**
     * @test
     */
    public function shouldDiscoverTv()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->discoverTv();
        $this->assertLastRequestIsWithPathAndMethod('/3/discover/tv');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Discover';
    }
}
