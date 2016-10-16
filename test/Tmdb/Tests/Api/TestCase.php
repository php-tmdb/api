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

use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\ApiToken;
use Tmdb\Client;
use Tmdb\Common\ParameterBag;
use Tmdb\Tests\TestCase as Base;

abstract class TestCase extends Base
{
    private $_api;

    /**
     * @var Client
     */
    private $_client;

    protected $clonedInitialAdapter;

    abstract protected function getApiClass();

    /**
     * Return regular objects but replace the http adapter to not actually send requests
     *
     * @param  array $options
     * @return mixed
     */
    protected function getApiWithMockedHttpAdapter(array $options = [])
    {
        $options['event_dispatcher'] = $this->eventDispatcher = new EventDispatcher();

        $this->_client = $this->getClientWithMockedHttpClient($options);
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
            ->setMethods($methods)
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
        return clone $this->_client->getHttpClient()->getAdapter();
    }
}
