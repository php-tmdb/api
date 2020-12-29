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

use Tmdb\ApiToken;
use Tmdb\Event\RequestEvent;
use Tmdb\Helper\RequestQueryHelper;

class ApiTokenRequestListener
{
    /**
     * @var ApiToken
     */
    private $token;

    /**
     * @var RequestQueryHelper
     */
    private $requestQueryHelper;

    /**
     * ApiTokenRequestListener constructor.
     * @param ApiToken $token
     */
    public function __construct(ApiToken $token)
    {
        $this->token = $token;
        $this->requestQueryHelper = new RequestQueryHelper();
    }

    /**
     * Add the API token to the headers.
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        $event->setRequest(
            $this->requestQueryHelper->withQuery($event->getRequest(), 'api_key', (string)$this->token)
        );
    }
}
