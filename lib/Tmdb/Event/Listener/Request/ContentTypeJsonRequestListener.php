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

namespace Tmdb\HttpClient\Event\Listener\Request;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\TmdbEvents;

class ContentTypeJsonRequestListener
{
    /**
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        $method = $event->getRequest()->getMethod();

        if (
            $method == 'POST' ||
            $method == 'PUT' ||
            $method == 'PATCH' ||
            $method == 'DELETE'
        ) {
            $event->getRequest()->withHeader('Content-Type', 'application/json');
        }
    }
}
