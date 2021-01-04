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

use Tmdb\Token\Session\GuestSessionToken;

class GuestSessionRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetRatedMovies()
    {
        $sessionToken = new GuestSessionToken('xyz');
        $repository   = $this->getRepositoryWithMockedHttpAdapter(['guest_session_token' => $sessionToken]);

        $repository->getRatedMovies();
        $this->assertLastRequestIsWithPathAndMethod(sprintf('/3/guest_session/%s/rated_movies', 'xyz'));
    }

    /**
     * @test
     */
    public function hasFactory()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->assertInstanceOf('Tmdb\Factory\GuestSessionFactory', $repository->getFactory());
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\GuestSession';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\GuestSessionRepository';
    }
}
