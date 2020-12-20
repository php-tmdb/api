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

use Tmdb\Event\RequestEvent;

class AdultFilterRequestListener
{
    private $includeAdult;

    public function __construct($includeAdult = false)
    {
        $this->includeAdult = $includeAdult;
    }

    public function onBeforeSend(RequestEvent $event): void
    {
        $event->getRequest()->getParameters()->set(
            'include_adult',
            $this->includeAdult === true ? 'true' : 'false'
        );
    }
}
