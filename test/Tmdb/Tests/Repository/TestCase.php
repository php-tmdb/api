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

use Psr\Http\Client\ClientInterface;
use Tmdb\Tests\TestCase as Base;
use Tmdb\Client;

abstract class TestCase extends Base
{
    protected $repository;

    /**
     * @var Client
     */
    private $_client;

    abstract protected function getRepositoryClass();

    /**
     * Return regular objects but replace the http adapter to not actually send requests
     *
     * @param  array $methods
     * @param  null  $sessionToken
     * @return mixed
     */
    protected function getRepositoryWithMockedHttpAdapter(array $methods = [], $sessionToken = null)
    {
        $this->_client = $this->getClientWithMockedHttpClient($methods);

        if ($sessionToken) {
            $this->_client->setSessionToken($sessionToken);
        }

        $repositoryClass = $this->getRepositoryClass();

        return new $repositoryClass($this->_client);
    }

    protected function getRepositoryWithMockedHttpClient()
    {
        $class = $this->getRepositoryClass();

        return new $class($this->getMockedTmdbClient());
    }

    protected function getRepositoryMock($client = null, array $methods = [])
    {
        if ($client == null) {
            $client  = $this->getMockedTmdbClient();
        }

        return $this->getMock($this->getRepositoryClass(), array_merge(['getApi'], $methods), [$client]);
    }

    /**
     * Shortcut to obtain the http client adapter
     *
     * @return ClientInterface
     */
    protected function getPsr18Client()
    {
        return $this->_client->getHttpClient()->getPsr18Client();
    }

    /**
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function getLastRequest()
    {
        $requests = $this->getPsr18Client()->getRequests();
        $lastRequest = array_pop($requests);

        return $lastRequest;
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
                $actualBody = \json_decode($actualBody, true);
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
