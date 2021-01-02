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

use Tmdb\Api\GuestSession;
use Tmdb\Exception\MissingSessionTokenException;
use Tmdb\Token\Session\GuestSessionToken;

class GuestSessionTest extends TestCase
{
    /**
     * @test
     *
     */
    public function shouldThrowExceptionGettingRatedMoviesWithNoSessionToken()
    {
        $this->expectException(MissingSessionTokenException::class);
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getRatedMovies();
    }

    /**
     * @test
     */
    public function shouldGetRatedMovies()
    {
        $sessionToken = new GuestSessionToken('xyz');
        $api = $this->getApiWithMockedHttpAdapter(['guest_session_token' => $sessionToken]);

        /** @var GuestSession $api */
        $api->getRatedMovies();
        $this->assertLastRequestIsWithPathAndMethod(sprintf('/3/guest_session/%s/rated_movies', 'xyz'));
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\GuestSession';
    }
}
