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

use Guzzle\Http\Message\Response;
use Tmdb\ApiToken;
use Tmdb\Client;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $repository;

    abstract protected function getRepositoryClass();

    protected function getRepositoryWithMockedHttpClient()
    {
        $class = $this->getRepositoryClass();

        return new $class($this->getMockedTmdbClient());
    }

    protected function getRepositoryMock($client = null, array $methods = array())
    {
        if ($client == null) {
            $client  = $this->getMockedTmdbClient();
        }

        return $this->getMock($this->getRepositoryClass(), array_merge(array('getApi'), $methods), array($client));
    }

    protected function getMockedTmdbClient()
    {
        $token    = new ApiToken('abcdef');
        $response = new Response('200');

        $httpClient = $this->getMock('Guzzle\Http\Client', array('send'));
        $httpClient
            ->expects($this->any())
            ->method('send')
            ->will($this->returnValue($response))
        ;

        return new Client($token, $httpClient);
    }
}