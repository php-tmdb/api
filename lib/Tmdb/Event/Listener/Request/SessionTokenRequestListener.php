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
use Tmdb\Token\Session\GuestSessionToken;
use Tmdb\Token\Session\SessionBearerToken;
use Tmdb\Token\Session\SessionToken;

class SessionTokenRequestListener
{
    private readonly \Tmdb\Helper\RequestQueryHelper $requestQueryHelper;

    /**
     * SessionTokenRequestListener constructor.
     */
    public function __construct(private readonly SessionToken $token)
    {
        $this->requestQueryHelper = new RequestQueryHelper();
    }

    /**
     * Set the token filter.
     */
    public function __invoke(RequestEvent $event): void
    {
        if ($this->token instanceof SessionBearerToken) {
            $event->setRequest(
                $event->getRequest()->withHeader('Authorization', \sprintf('Bearer %s', (string) $this->token)),
            );

            return;
        }

        $key = $this->token instanceof GuestSessionToken ? 'guest_session_id' : 'session_id';

        $event->setRequest(
            $this->requestQueryHelper->withQuery($event->getRequest(), $key, (string) $this->token),
        );
    }
}
