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
use Tmdb\Event\Listener\Logger\LogApiErrorListener;
use Tmdb\Event\TmdbExceptionEvent;
use Tmdb\Exception\TmdbApiException;
use WMDE\PsrLogTestDoubles\LoggerSpy;

class LogApiErrorListenerTest extends LoggerListenerTestCase
{
    /**
     * @test
     */
    public function shouldLogApiError()
    {
        $logger = new LoggerSpy();
        $event = new TmdbExceptionEvent(new TmdbApiException(7, 'invalid api key'));

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(TmdbExceptionEvent::class, new LogApiErrorListener($logger));
        $eventDispatcher->dispatch($event);

        $expectedMessage = <<<EXCEPTION
Critical API exception:
7 invalid api key
EXCEPTION;

        $this->assertCount(1, $logger->getLogCalls());
        $this->assertSame([$expectedMessage], $logger->getLogCalls()->getMessages());
    }
}
