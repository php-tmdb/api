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

namespace Tmdb\Event;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tmdb\Token\Session\SessionToken;

/**
 * Class RequestEvent.
 */
class RequestEvent extends StoppableEvent implements LoggableHttpEventInterface
{
    private ?\Psr\Http\Message\ResponseInterface $response = null;

    /**
     * Construct the request event.
     */
    public function __construct(private RequestInterface $request, private ?SessionToken $sessionToken = null)
    {
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function setRequest(RequestInterface $request): RequestEvent
    {
        $this->request = $request;

        return $this;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    public function setResponse(ResponseInterface $response): RequestEvent
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasResponse()
    {
        return $this->response instanceof ResponseInterface;
    }

    public function getSessionToken(): ?SessionToken
    {
        return $this->sessionToken;
    }

    public function setSessionToken(?SessionToken $sessionToken = null): RequestEvent
    {
        $this->sessionToken = $sessionToken;

        return $this;
    }

    public function hasSessionToken(): bool
    {
        return $this->sessionToken instanceof SessionToken;
    }
}
