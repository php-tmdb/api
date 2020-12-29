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

class CertificationsTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetCertificationsListForMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getMovieList();
        $this->assertLastRequestIsWithPathAndMethod('/3/certification/movie/list');
    }

    /**
     * @test
     */
    public function shouldGetCertificationsListForTv()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTvList();
        $this->assertLastRequestIsWithPathAndMethod('/3/certification/tv/list');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Certifications';
    }
}
