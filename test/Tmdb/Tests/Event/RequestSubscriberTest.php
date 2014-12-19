<?php
namespace Tmdb\Tests\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\RequestSubscriber;
use Tmdb\Event\TmdbEvents;
use Tmdb\HttpClient\HttpClientEventSubscriber;
use Tmdb\HttpClient\Request;
use Tmdb\HttpClient\Response;

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
class RequestSubscriberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Tmdb\Exception\RuntimeException
     * @test
     */
    public function throwsExceptionWithNonExistingMethod()
    {
        $subscriber   = new RequestSubscriber();
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
        $eventDispatcher->addSubscriber(new RequestSubscriber());

        $requestEvent = new RequestEvent(new Request('/', '1337'));
        $eventDispatcher->dispatch(TmdbEvents::REQUEST, $requestEvent);

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
        $response = new Response(301);
        $event->setResponse($response);

        $event->stopPropagation();

        return $response;
    }
}
