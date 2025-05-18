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

use Psr\Http\Message\ResponseInterface;
use Tmdb\Exception\TmdbApiException;

class TmdbExceptionEvent extends StoppableEvent
{
    private ?\Psr\Http\Message\ResponseInterface $response = null;

    /**
     * Constructor.
     */
    public function __construct(private readonly TmdbApiException $exception)
    {
    }

    public function getException(): TmdbApiException
    {
        return $this->exception;
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
