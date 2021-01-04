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

use InvalidArgumentException;
use Tmdb\HttpClient\ResponseInterface;
use Tmdb\Token\Session\RequestToken;

class AuthenticationTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetNewToken()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getNewToken();
        $this->assertLastRequestIsWithPathAndMethod('/3/authentication/token/new');
    }

    /**
     * @test
     */
    public function shouldGetNewSession()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getNewSession(new RequestToken('request_token'));
        $this->assertLastRequestIsWithPathAndMethod('/3/authentication/session/new');
        $this->assertRequestHasQueryParameters(
            [
                'request_token' => 'request_token'
            ]
        );
    }

    /**
     * @todo
     */
    public function shouldValidateRequestTokenWithLogin()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $response = new ResponseInterface(200);
        $response->setBody(
            json_encode(
                [
                    'success' => true,
                    'request_token' => 'abcdefghijklmnopqrstuvwxyz'
                ]
            )
        );

        $this->getPsr18Client()
            ->expects($this->any())
            ->method('get')
            ->with(
                $this->getRequest(
                    'https://api.themoviedb.org/3/authentication/token/validate_with_login',
                    [
                        'request_token' => 'request_token',
                        'username' => 'piet',
                        'password' => 'henk'
                    ]
                )
            )
            ->willReturn($response);

        $api->validateRequestTokenWithLogin(new RequestToken('request_token'), 'piet', 'henk');
    }

    /**
     * @todo
     */
    public function shouldGetSessionTokenWithLogin()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $response = new ResponseInterface(200);
        $response->setBody(
            json_encode(
                [
                    'success' => true,
                    'request_token' => 'abcdefghijklmnopqrstuvwxyz'
                ]
            )
        );

        $api->getClient()->getAdapter()
            ->expects($this->any())
            ->method('get')
            ->with(
                $this->getRequest(
                    'https://api.themoviedb.org/3/authentication/token/validate_with_login',
                    [
                        'request_token' => 'request_token',
                        'username' => 'piet',
                        'password' => 'henk'
                    ]
                )
            )
            ->willReturn($response);

        $api->getSessionTokenWithLogin(new RequestToken('request_token'), 'piet', 'henk');
    }

    /**
     * @todo
     * @expectedException InvalidArgumentException
     */
    public function shouldThrowExceptionWhenNotValidated()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $response = new ResponseInterface(200);
        $response->setBody(
            json_encode(
                [
                    'success' => false
                ]
            )
        );

        $api->getClient()->getAdapter()
            ->expects($this->any())
            ->method('get')
            ->with(
                $this->getRequest(
                    'https://api.themoviedb.org/3/authentication/token/validate_with_login',
                    [
                        'request_token' => 'request_token',
                        'username' => 'piet',
                        'password' => 'henk'
                    ]
                )
            )
            ->will($this->returnValue($response));

        $api->getSessionTokenWithLogin(new RequestToken('request_token'), 'piet', 'henk');
    }

    /**
     * @test
     */
    public function shouldGetNewGuestSession()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getNewGuestSession();
        $this->assertLastRequestIsWithPathAndMethod('/3/authentication/guest_session/new');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Authentication';
    }
}
