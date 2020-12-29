<?php

namespace Tmdb\Tests\Event;

use Nyholm\Psr7\Factory\Psr17Factory;
use PhpCsFixer\Event\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Tests\TestCase;

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
class RequestListenerTest extends TestCase
{
    /**
     * @test
     */
    public function canReturnEarlyResponse()
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com');
        $event   = new RequestEvent($request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            RequestEvent::class,
            new RequestListener(new HttpClient(), $eventDispatcher)
        );
        $eventDispatcher->addListener(
            BeforeRequestEvent::class,
            new FakeTestListener()
        );
        $eventDispatcher->dispatch($event);
        $response = $event->getResponse();

        $this->assertEquals(301, $response->getStatusCode());
    }
}

class FakeTestListener
{
    public function __invoke(RequestEvent $event)
    {
        $factory = new Psr17Factory();
        $response = $factory->createResponse(301, 'hello world');
        $event->setResponse($response);

        $event->stopPropagation();
    }
}
