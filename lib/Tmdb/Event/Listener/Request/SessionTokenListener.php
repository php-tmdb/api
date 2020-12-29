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

namespace Tmdb\Event\Listener\Request;

use Tmdb\Event\RequestEvent;
use Tmdb\GuestSessionToken;
use Tmdb\SessionToken;

class SessionTokenListener
{
    /**
     * @var SessionToken
     */
    private $token;

    public function __construct(SessionToken $token)
    {
        $this->token = $token;
    }

    /**
     * Add the API token to the headers.
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        $queryParameters = array();
        $token = $this->token->getToken();

        parse_str($event->getRequest()->getUri()->getQuery(), $queryParameters);

        if ($this->token instanceof GuestSessionToken) {
            $queryParameters['guest_session_id'] = $token;
        } else {
            $queryParameters['session_id'] = $token;
        }

        $uri = $event->getRequest()->getUri()->withQuery(http_build_query($queryParameters));
        $event->setRequest(
            $event->getRequest()->withUri($uri)
        );

        // @todo new auth
        //$event->getRequest()->withHeader('Authorization', sprintf('Bearer %s', (string)$this->token));
    }
}
