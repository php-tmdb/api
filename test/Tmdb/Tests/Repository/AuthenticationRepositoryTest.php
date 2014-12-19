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

use Tmdb\Api\Authentication;
use Tmdb\Repository\AuthenticationRepository;

class AuthenticationRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetRequestToken()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('authentication/token/new', []))
        ;

        $repository->getRequestToken();
    }

    /**
     * @test
     */
    public function shouldGetGuestSession()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('authentication/guest_session/new', []))
        ;

        $repository->getGuestSessionToken();
    }

    /**
     * @return Authentication
     */
    protected function getApiClass()
    {
        return 'Tmdb\Api\Authentication';
    }

    /**
     * @return AuthenticationRepository
     */
    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\AuthenticationRepository';
    }
}
