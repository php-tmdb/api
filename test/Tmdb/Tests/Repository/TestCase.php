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
     * @return \Tmdb\HttpClient\Adapter\AdapterInterface
     */
    protected function getAdapter()
    {
        return $this->_client->getHttpClient()->getAdapter();
    }
}
