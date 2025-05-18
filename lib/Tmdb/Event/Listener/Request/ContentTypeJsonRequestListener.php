<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Event\Listener\Request;

use Tmdb\Event\RequestEvent;

class ContentTypeJsonRequestListener
{
    public function __invoke(RequestEvent $event): void
    {
        $method = $event->getRequest()->getMethod();

        if (
            'POST' === $method
            || 'PUT' === $method
            || 'PATCH' === $method
            || 'DELETE' === $method
        ) {
            $event->setRequest(
                $event->getRequest()->withHeader('Content-Type', 'application/json'),
            );
        }
    }
}
