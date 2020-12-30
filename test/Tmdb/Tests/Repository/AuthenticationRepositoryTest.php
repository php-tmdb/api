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

use Tmdb\Api\Authentication;
use Tmdb\HttpClient\ResponseInterface;
use Tmdb\Repository\AuthenticationRepository;
use Tmdb\Token\Session\RequestToken;

class AuthenticationRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetRequestToken()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getRequestToken();
        $this->assertLastRequestIsWithPathAndMethod('/3/authentication/token/new');
    }

    /**
     * @test
     */
    public function shouldGetNewSession()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getSessionToken(new RequestToken('request_token'));
        $this->assertLastRequestIsWithPathAndMethod('/3/authentication/session/new');
        $this->assertRequestHasQueryParameters([
                                                   'request_token' => 'request_token'
                                               ]);
    }

    /**
     * @todo
     */
    public function shouldValidateRequestTokenWithLogin()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $response = new ResponseInterface(200);
        $response->setBody(json_encode([
            'success' => true,
            'request_token' => 'abcdefghijklmnopqrstuvwxyz'
        ]));

        $this->getPsr18Client()
            ->expects($this->any())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/authentication/token/validate_with_login', [
                'request_token' => 'request_token',
                'username' => 'piet',
                'password' => 'henk'
            ]))
            ->will($this->returnValue($response))
        ;

        $repository->validateRequestTokenWithLogin(new RequestToken('request_token'), 'piet', 'henk');
    }

    /**
     * @todo
     */
    public function shouldGetGuestSession()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getPsr18Client()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/authentication/guest_session/new', []))
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
