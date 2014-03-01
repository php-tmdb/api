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
}
