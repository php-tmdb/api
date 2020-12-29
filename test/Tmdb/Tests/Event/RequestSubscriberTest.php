<?php

namespace Tmdb\Tests\Event;

use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\TmdbEvents;
use Tmdb\Exception\RuntimeException;
use Tmdb\HttpClient\HttpClient;
use Tmdb\HttpClient\HttpClientEventSubscriber;
use Tmdb\HttpClient\Request;
use Tmdb\HttpClient\ResponseInterface;

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
class RequestSubscriberTest extends TestCase
{
    /**
     *
     * @test
     */
    public function throwsExceptionWithNonExistingMethod()
    {
        $this->expectException(RuntimeException::class);
        $subscriber = new RequestListener(new HttpClient(), new EventDispatcher());
        $requestEvent = new RequestEvent(new Request('/', '1337'));

        $subscriber->sendRequest($requestEvent);
    }

    /**
     * @test
     */
    public function canReturnEarlyResponse()
    {
        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addSubscriber(new FakeCacheSubscriber());
        $eventDispatcher->addSubscriber(new RequestListener());

        $requestEvent = new RequestEvent(new Request('/', '1337'));
        $eventDispatcher->dispatch($requestEvent, TmdbEvents::REQUEST);

        $response = $requestEvent->getResponse();

        $this->assertEquals(301, $response->getCode());
    }
}

class FakeCacheSubscriber extends HttpClientEventSubscriber
{
    public static function getSubscribedEvents()
    {
        return [
            TmdbEvents::BEFORE_REQUEST => 'isCached',
        ];
    }

    public function isCached(RequestEvent $event)
    {
        $response = new ResponseInterface(301);
        $event->setResponse($response);

        $event->stopPropagation();

        return $response;
    }
}
