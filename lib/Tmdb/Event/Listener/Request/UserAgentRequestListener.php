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

use Tmdb\Client;
use Tmdb\Event\RequestEvent;

class UserAgentRequestListener
{
    /**
     * Add the API token to the headers.
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        $event->getRequest()->withHeader('User-Agent', sprintf('php-tmdb/api (v%s)', Client::VERSION));
    }
}
