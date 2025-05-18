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
use Symfony\Contracts\EventDispatcher\Event;

class ResponseEvent implements LoggableHttpEventInterface
{
    /**
     * Construct the request event.
     */
    public function __construct(private ResponseInterface $response, private RequestInterface $request)
    {
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @param RequestInterface $request
     */
    public function setRequest($request): static
    {
        $this->request = $request;

        return $this;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function setResponse(ResponseInterface $response): static
    {
        $this->response = $response;

        return $this;
    }

    public function hasResponse(): bool
    {
        return null !== $this->response;
    }

    public function hasRequest(): bool
    {
        return null !== $this->request;
    }
}
