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

use Tmdb\Client;
use Tmdb\Tests\TestCase as Base;

abstract class TestCase extends Base
{
    private $_api;

    /**
     * @var Client
     */
    private $_client;

    abstract protected function getApiClass();

    protected function getApiMock(array $methods = [], array $clientMethods = [], $sessionToken = null)
    {
        if ($this->_api) {
            return $this->_api;
        }

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
            ->getMock();
    }

    protected function getAdapter()
    {
        return $this->_client->getHttpClient()->getAdapter();
    }
}
