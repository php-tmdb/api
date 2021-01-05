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

use PHPUnit_Framework_MockObject_MockObject;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Client;
use Tmdb\Common\ParameterBag;
use Tmdb\Tests\TestCase as Base;
use Tmdb\Token\Session\GuestSessionToken;

use function json_decode;

abstract class TestCase extends Base
{
    protected $clonedInitialAdapter;
    private $_api;
    /**
     * @var Client
     */
    private $_client;

    /**
     * Return regular objects but replace the http adapter to not actually send requests
     *
     * @param array $options
     * @return mixed
     */
    protected function getApiWithMockedHttpAdapter(array $options = [])
    {
        $this->_client = $this->getClientWithMockedHttpClient($options);
        $apiClass = $this->getApiClass();

        return new $apiClass($this->_client);
    }

    abstract protected function getApiClass();

    /**
     * Mock the API methods themselfs
     *
     * @param array $methods
     * @param array $clientMethods
     * @param GuestSessionToken|null $sessionToken
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockedApi(array $methods = [], array $clientMethods = [], $guestSessionToken = null)
    {
        $this->_client = $this->getClientWithMockedHttpClient($clientMethods);

        if ($guestSessionToken) {
            $this->_client->setGuestSessionToken($guestSessionToken);
        }

        return $this->_api = $this->getMockBuilder($this->getApiClass())
            ->setMethods($methods)
            ->setConstructorArgs([$this->_client])
            ->getMock();
    }

    /**
     * Provide the default query parameters to merge in
     *
     * @return array
     */
    protected function getDefaultQueryParameters()
    {
        return [
            'secure' => false,
            'base_url' => 'http://api.themoviedb.org/3/',
            'headers' => new ParameterBag(['accept' => 'application/json']),
            'token' => new ApiToken('abcdef')
        ];
    }

    /**
     * @param $path
     * @param string $method
     */
    protected function assertLastRequestIsWithPathAndMethod($path, $method = 'GET')
    {
        $lastRequest = $this->getLastRequest();

        $this->assertEquals($path, $lastRequest->getUri()->getPath());
        $this->assertEquals($method, $lastRequest->getMethod());
    }

    /**
     * @return RequestInterface
     */
    protected function getLastRequest()
    {
        $requests = $this->getPsr18Client()->getRequests();
        $lastRequest = array_pop($requests);

        return $lastRequest;
    }

    /**
     * Shortcut to obtain the http client adapter
     *
     * @return ClientInterface|\Http\Mock\Client
     */
    protected function getPsr18Client()
    {
        return clone $this->_client->getHttpClient()->getPsr18Client();
    }

    /**
     * @param mixed $contents
     */
    protected function assertRequestBodyHasContents($contents)
    {
        $lastRequest = $this->getLastRequest();
        $lastRequest->getBody()->rewind();

        $actualBody = $lastRequest->getBody()->getContents();

        if ($lastRequest->hasHeader('content-type')) {
            $contentType = $lastRequest->getHeader('content-type')[0];

            if ('application/json' === $contentType) {
                $actualBody = json_decode($actualBody, true);
            }
        }

        $this->assertEquals($contents, $actualBody);
    }

    /**
     * @param array $parameters
     */
    protected function assertRequestHasQueryParameters(array $parameters = array())
    {
        $actualParameters = array();
        parse_str($this->getLastRequest()->getUri()->getQuery(), $actualParameters);
        $this->assertEquals($parameters, $actualParameters);
    }
}
