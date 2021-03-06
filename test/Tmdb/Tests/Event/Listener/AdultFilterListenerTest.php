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
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Request\AdultFilterRequestListener;

class AdultFilterListenerTest extends ListenerTestCase
{
    /**
     * @test
     */
    public function shouldSetAcceptsApplicationJson()
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com');
        $event   = new BeforeRequestEvent($request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(BeforeRequestEvent::class, new AdultFilterRequestListener());
        $eventDispatcher->dispatch($event);

        $this->assertEquals('include_adult=false', $event->getRequest()->getUri()->getQuery());
    }
}
