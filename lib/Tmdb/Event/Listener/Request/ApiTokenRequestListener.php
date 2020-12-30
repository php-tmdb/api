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

use Tmdb\Token\Api\ApiToken;
use Tmdb\Token\Api\BearerToken;
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
        if ($this->token instanceof BearerToken) {
            $event->setRequest(
                $event->getRequest()->withHeader('Authorization', sprintf('Bearer %s', (string)$this->token))
            );
        } else {
            $event->setRequest(
                $this->requestQueryHelper->withQuery($event->getRequest(), 'api_key', (string)$this->token)
            );
        }
    }
}
