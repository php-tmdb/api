<?php
/**
 * This file is part of the Wrike PHP API created by B-Found IM&S.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @package Wrike
 * @author Michael Roterman <michael@b-found.nl>
 * @copyright (c) 2013, B-Found Internet Marketing & Services
 * @version 0.0.1
 */
namespace Tmdb\Tests\Api;

use Tmdb\ApiToken;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    abstract protected function getApiClass();

    protected function getApiMock()
    {
        $token      = new ApiToken('abcdef');

        $httpClient = $this->getMock('Guzzle\Http\Client', array('send'));
        $httpClient
            ->expects($this->any())
            ->method('send');

        $mock = $this->getMock('Tmdb\HttpClient\HttpClientInterface', array(), array(array(), $httpClient));

        $client = new \Tmdb\Client($token, $httpClient);
        $client->setHttpClient($mock);

        return $this->getMockBuilder($this->getApiClass())
            ->setMethods(array('get', 'post', 'postRaw', 'patch', 'delete', 'put'))
            ->setConstructorArgs(array($client))
            ->getMock();
    }
}