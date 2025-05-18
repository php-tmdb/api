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

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClientExceptionEvent extends StoppableEvent implements LoggableHttpEventInterface
{
    private ?\Psr\Http\Message\ResponseInterface $response = null;

    /**
     * Constructor.
     */
    public function __construct(private readonly ClientExceptionInterface $exception, private readonly RequestInterface $request)
    {
    }

    public function getException(): ClientExceptionInterface
    {
        return $this->exception;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function hasResponse(): bool
    {
        return null !== $this->response;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }
}
