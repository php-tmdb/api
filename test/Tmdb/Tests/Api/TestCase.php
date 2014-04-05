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

use Tmdb\Tests\TestCase as Base;

abstract class TestCase extends Base
{
    private $_api = null;

    abstract protected function getApiClass();

    protected function getApiMock(array $methods = array(), array $clientMethods = array(), $sessionToken = null)
    {
        if ($this->_api) {
            return $this->_api;
        }

        $client = $this->getClientWithMockedHttpClient($clientMethods);

        if ($sessionToken) {
            $client->setSessionToken($sessionToken);
        }

        return $this->getMockBuilder($this->getApiClass())
            ->setMethods(
                array_merge(
                    array('get', 'post', 'postJson', 'postRaw', 'head', 'patch', 'delete', 'put'),
                    $methods
                )
            )
            ->setConstructorArgs(array($client))
            ->getMock();
    }
}
