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

namespace Tmdb\Tests\Event\Listener;

use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Token\Api\BearerToken;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Request\ApiTokenRequestListener;
use Tmdb\Event\Listener\Request\SessionTokenRequestListener;
use Tmdb\Token\Session\GuestSessionToken;
use Tmdb\Token\Session\SessionBearerToken;
use Tmdb\Token\Session\SessionToken;

class SessionTokenListenerTest extends ListenerTestCase
{
    /**
     * @test
     */
    public function shouldSetGuestToken()
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com');
        $event   = new BeforeRequestEvent($request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            BeforeRequestEvent::class,
            new SessionTokenRequestListener(
                new GuestSessionToken('12345')
            )
        );
        $eventDispatcher->dispatch($event);

        $this->assertEquals('guest_session_id=12345', $event->getRequest()->getUri()->getQuery());
    }

    /**
     * @test
     */
    public function shouldSetToken()
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com');
        $event   = new BeforeRequestEvent($request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            BeforeRequestEvent::class,
            new SessionTokenRequestListener(
                new SessionToken('12345')
            )
        );
        $eventDispatcher->dispatch($event);

        $this->assertEquals('session_id=12345', $event->getRequest()->getUri()->getQuery());
    }

    /**
     * @test
     */
    public function shouldSetBearerToken()
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com');
        $event   = new BeforeRequestEvent($request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            BeforeRequestEvent::class,
            new SessionTokenRequestListener(
                new SessionBearerToken('12345')
            )
        );
        $eventDispatcher->dispatch($event);

        $this->assertTrue($event->getRequest()->hasHeader('authorization'));

        if ($event->getRequest()->hasHeader('authorization')) {
            $this->assertEquals('Bearer 12345', $event->getRequest()->getHeaderLine('authorization'));
        }
    }

    /**
     * @test
     */
    public function shouldReplaceBearerToken()
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com');
        $event   = new BeforeRequestEvent($request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            BeforeRequestEvent::class,
            new ApiTokenRequestListener(
                new BearerToken('12345')
            )
        );
        $eventDispatcher->dispatch($event);

        $this->assertTrue($event->getRequest()->hasHeader('authorization'));

        if ($event->getRequest()->hasHeader('authorization')) {
            $this->assertEquals('Bearer 12345', $event->getRequest()->getHeaderLine('authorization'));
        }

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            BeforeRequestEvent::class,
            new SessionTokenRequestListener(
                new SessionBearerToken('foobar')
            )
        );
        $eventDispatcher->dispatch($event);

        $this->assertTrue($event->getRequest()->hasHeader('authorization'));

        if ($event->getRequest()->hasHeader('authorization')) {
            $this->assertEquals('Bearer foobar', $event->getRequest()->getHeaderLine('authorization'));
        }
    }
}
