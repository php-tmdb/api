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

namespace Tmdb\Event;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\StoppableEventInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Contracts\EventDispatcher\Event;
use Tmdb\HttpClient\Request;
use Tmdb\Token\Session\SessionToken;

class RequestEvent extends StoppableEvent
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var SessionToken
     */
    private $sessionToken;

    /**
     * Construct the request event
     *
     * @param RequestInterface $request
     * @param SessionToken|null $sessionToken
     */
    public function __construct(RequestInterface $request, SessionToken $sessionToken = null)
    {
        $this->request = $request;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @param RequestInterface $request
     * @return $this
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     * @return $this
     */
    public function setResponse(ResponseInterface $response)
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

    /**
     * @return SessionToken
     */
    public function getSessionToken(): SessionToken
    {
        return $this->sessionToken;
    }

    /**
     * @param SessionToken|null $sessionToken
     */
    public function setSessionToken(SessionToken $sessionToken = null): void
    {
        $this->sessionToken = $sessionToken;
    }

    /**
     * @return bool
     */
    public function hasSessionToken()
    {
        return $this->response instanceof ResponseInterface;
    }

}
