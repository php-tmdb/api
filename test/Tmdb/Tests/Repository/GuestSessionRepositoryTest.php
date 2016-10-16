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
namespace Tmdb\Tests\Repository;

use Tmdb\GuestSessionToken;

class GuestSessionRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetRatedMovies()
    {
        $sessionToken = new GuestSessionToken('xyz');
        $repository   = $this->getRepositoryWithMockedHttpAdapter(['session_token' => $sessionToken]);

        $request = $this->getRequest(
            sprintf('https://api.themoviedb.org/3/guest_session/%s/rated_movies', (string) $sessionToken),
            ['guest_session_id' => (string) $sessionToken]
        );
        $request->getOptions()->set('session_token', $sessionToken);

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($request);

        $repository->getRatedMovies();
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
