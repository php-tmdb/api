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
use Tmdb\HttpClient\Response;
use Tmdb\Repository\AuthenticationRepository;
use Tmdb\RequestToken;

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
    public function shouldGetNewSession()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('authentication/session/new', ['request_token' => 'request_token']))
        ;

        $repository->getSessionToken(new RequestToken('request_token'));
    }

    /**
     * @test
     */
    public function shouldValidateRequestTokenWithLogin()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $response = new Response(200);
        $response->setBody(json_encode([
            'success' => true,
            'request_token' => 'abcdefghijklmnopqrstuvwxyz'
        ]));

        $this->getAdapter()
            ->expects($this->any())
            ->method('get')
            ->with($this->getRequest('authentication/token/validate_with_login', [
                'request_token' => 'request_token',
                'username' => 'piet',
                'password' => 'henk'
            ]))
            ->will($this->returnValue($response))
        ;

        $repository->validateRequestTokenWithLogin(new RequestToken('request_token'), 'piet', 'henk');
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
