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
use Tmdb\Helper\RequestQueryHelper;

class AdultFilterRequestListener
{
    private readonly \Tmdb\Helper\RequestQueryHelper $requestQueryHelper;

    /**
     * AdultFilterRequestListener constructor.
     *
     * @param bool $includeAdult
     */
    public function __construct(private $includeAdult = false)
    {
        $this->requestQueryHelper = new RequestQueryHelper();
    }

    /**
     * Set the adult filter.
     */
    public function __invoke(RequestEvent $event): void
    {
        $event->setRequest(
            $this->requestQueryHelper->withQuery(
                $event->getRequest(),
                'include_adult',
                true === $this->includeAdult ? 'true' : 'false',
            ),
        );
    }
}
