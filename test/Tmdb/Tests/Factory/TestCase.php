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
namespace Tmdb\Tests\Factory;

use Tmdb\ApiToken;
use Tmdb\Client;
use Tmdb\Tests\TestCase as Base;

abstract class TestCase extends Base
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client(new ApiToken('abcdef'));
    }

    protected $factory;

    protected function getFactory()
    {
        $class = $this->getFactoryClass();

        return new $class($this->client->getHttpClient());
    }

    protected function getHttpClient()
    {
        return $this->client->getHttpClient();
    }

    abstract protected function getFactoryClass();
}
