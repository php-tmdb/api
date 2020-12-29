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

use Tmdb\Event\RequestEvent;
use Tmdb\Helper\RequestQueryHelper;

class AdultFilterRequestListener
{
    private $includeAdult;
    /**
     * @var RequestQueryHelper
     */
    private $requestQueryHelper;

    /**
     * AdultFilterRequestListener constructor.
     * @param bool $includeAdult
     */
    public function __construct($includeAdult = false)
    {
        $this->includeAdult = $includeAdult;
        $this->requestQueryHelper = new RequestQueryHelper();
    }

    /**
     * Set the adult filter.
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        $event->setRequest(
            $this->requestQueryHelper->withQuery(
                $event->getRequest(),
                'include_adult',
                $this->includeAdult === true ? 'true' : 'false'
            )
        );
    }
}
