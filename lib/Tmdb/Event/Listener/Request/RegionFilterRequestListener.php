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

namespace Tmdb\Event\Listener\Request;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tmdb\Event\RequestEvent;
use Tmdb\Helper\RequestQueryHelper;

class RegionFilterRequestListener
{
    /**
     * @var string
     */
    private $region;

    /**
     * @var RequestQueryHelper
     */
    private $requestQueryHelper;

    /**
     * RegionFilterRequestListener constructor.
     * @param string $region
     */
    public function __construct($region = 'en')
    {
        $this->region = $region;
        $this->requestQueryHelper = new RequestQueryHelper();
    }

    /**
     * Set the region filter.
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        $event->setRequest(
            $this->requestQueryHelper->withQuery($event->getRequest(), 'region', $this->region)
        );
    }
}
