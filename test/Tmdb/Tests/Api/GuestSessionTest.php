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

use Tmdb\GuestSessionToken;

class GuestSessionTest extends TestCase
{
    /**
     * @test
     * @expectedException \Tmdb\Exception\MissingSessionTokenException
     */
    public function shouldThrowExceptionGettingRatedMoviesWithNoSessionToken()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getRatedMovies();
    }

    /**
     * @test
     */
    public function shouldGetRatedMovies()
    {
        $sessionToken = new GuestSessionToken('xyz');
        $api          = $this->getApiWithMockedHttpAdapter([], $sessionToken);

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('guest_session/xyz/rated_movies', ['guest_session_id' => 'xyz']));

        $api->getRatedMovies();
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\GuestSession';
    }
}
