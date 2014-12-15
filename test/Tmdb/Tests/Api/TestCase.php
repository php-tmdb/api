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

use Tmdb\ApiToken;
use Tmdb\Client;
use Tmdb\Common\ParameterBag;
use Tmdb\HttpClient\Request;
use Tmdb\Tests\TestCase as Base;

abstract class TestCase extends Base
{
    private $_api;

    /**
     * @var Client
     */
    private $_client;

    abstract protected function getApiClass();

    /**
     * Return regular objects but replace the http adapter to not actually send requests
     *
     * @param  array $methods
     * @param  array $clientMethods
     * @param  null  $sessionToken
     * @return mixed
     */
    protected function getApiWithMockedHttpAdapter(array $methods = [], array $clientMethods = [], $sessionToken = null)
    {
        $this->_client = $this->getClientWithMockedHttpClient($clientMethods);

        if ($sessionToken) {
            $this->_client->setSessionToken($sessionToken);
        }

        $apiClass = $this->getApiClass();

        return new $apiClass($this->_client);
    }

    /**
     * Mock the API methods themselfs
     *
     * @param  array                                    $methods
     * @param  array                                    $clientMethods
     * @param  null                                     $sessionToken
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockedApi(array $methods = [], array $clientMethods = [], $sessionToken = null)
    {
        $this->_client = $this->getClientWithMockedHttpClient($clientMethods);

        if ($sessionToken) {
            $this->_client->setSessionToken($sessionToken);
        }

        return $this->_api = $this->getMockBuilder($this->getApiClass())
            ->setMethods(
                array_merge(
                    [],
                    $methods
                )
            )
            ->setConstructorArgs([$this->_client])
            ->getMock()
        ;
    }

    /**
     * Provide the default query parameters to merge in
     *
     * @return array
     */
    protected function getDefaultQueryParameters()
    {
        return [
            'secure'   => false,
            'base_url' => 'http://api.themoviedb.org/3/',
            'headers'  => new ParameterBag(['accept' => 'application/json']),
            'token'    => new ApiToken('abcdef')
        ];
    }

    /**
     * Shortcut to obtain the http client adapter
     *
     * @return \Tmdb\HttpClient\Adapter\AdapterInterface
     */
    protected function getAdapter()
    {
        return $this->_client->getHttpClient()->getAdapter();
    }

    protected function getRequest($path, $parameters = [], $method = 'GET', $headers = [], $body = null)
    {
        if (
            $method == 'POST'  ||
            $method == 'PUT'   ||
            $method == 'PATCH' ||
            $method == 'DELETE'
        ) {
            $headers = array_merge($headers, ['Content-Type' => 'application/json']);
        }

        $request = new Request(
            $path,
            $method,
            new ParameterBag(array_merge(
                    $parameters,
                    [
                        'api_key' => new ApiToken('abcdef')
                    ]
                )
            ),
            new ParameterBag(array_merge(
                    $headers,
                    [
                        'Accept' => 'application/json'
                    ]
                )
            )
        );

        $request->setOptions(new ParameterBag([
            'token'  => new ApiToken('abcdef'),
            'secure' => false
        ]));

        if ($body !== null) {
            $request->setBody(is_array($body) ? json_encode($body) : $body);
        }

        return $request;
    }
}
