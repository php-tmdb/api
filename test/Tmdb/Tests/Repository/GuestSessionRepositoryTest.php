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
    public function shouldGetRatedItems()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter([], new GuestSessionToken('xyz'));

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('guest_session/xyz/rated_movies', ['guest_session_id' => 'xyz']));

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
