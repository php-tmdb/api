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

namespace Tmdb\Tests\Factory;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Client;
use Tmdb\Event\HydrationEvent;
use Tmdb\Event\Listener\HydrationListener;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Tests\TestCase as Base;

abstract class TestCase extends Base
{
    /**
     * @var Client
     */
    private $client;

    protected $factory;

    protected function getFactory()
    {
        $class = $this->getFactoryClass();

        $ed = new EventDispatcher();
        $ed->addListener(HydrationEvent::class, new HydrationListener($ed));
        $client = new Client(
            [
                'api_token' => new ApiToken('abcdef'),
                'event_dispatcher' => ['adapter' => $ed]
            ]
        );

        return new $class($client->getHttpClient());
    }

    /**
     * @return HttpClient
     */
    protected function getHttpClient()
    {
        $ed = new EventDispatcher();
        $ed->addListener(HydrationEvent::class, new HydrationListener($ed));
        $client = new Client(
            [
                'api_token' => new ApiToken('test'),
                'event_dispatcher' => ['adapter' => new EventDispatcher()]
            ]
        );

        return $client->getHttpClient();
    }

    abstract protected function getFactoryClass();
}
