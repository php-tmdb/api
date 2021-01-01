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

namespace Tmdb\Tests\Event\Listener\Logger;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Event\Listener\Logger\LogHydrationListener;
use Tmdb\Formatter\Hydration\SimpleHydrationFormatter;
use Tmdb\Model\Movie;
use WMDE\PsrLogTestDoubles\LoggerSpy;

class LogHydrationListenerTest extends LoggerListenerTestCase
{
    /**
     * @test
     */
    public function shouldLogHydrationWithoutData()
    {
        $logger = new LoggerSpy();
        $event = new BeforeHydrationEvent(new Movie(), ['id' => 123]);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(BeforeHydrationEvent::class, new LogHydrationListener($logger));
        $eventDispatcher->dispatch($event);

        $this->assertCount(1, $logger->getLogCalls());
        $this->assertSame(['Hydrating model "Tmdb\Model\Movie".'], $logger->getLogCalls()->getMessages());
    }

    /**
     * @test
     */
    public function shouldLogHydrationWithData()
    {
        $logger = new LoggerSpy();
        $event = new BeforeHydrationEvent(new Movie(), ['id' => 123]);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(BeforeHydrationEvent::class, new LogHydrationListener(
            $logger,
            new SimpleHydrationFormatter(),
            true
        ));
        $eventDispatcher->dispatch($event);

        $messages = $logger->getLogCalls()->getMessages();
        $this->assertCount(1, $logger->getLogCalls());
        $this->assertSame(['Hydrating model "Tmdb\Model\Movie".'], $messages);
        $this->assertSame(['id' => 123], $logger->getLogCalls()->getFirstCall()->getContext()['data']);
        $this->assertEquals(10, $logger->getLogCalls()->getFirstCall()->getContext()['data_size']);
    }
}
