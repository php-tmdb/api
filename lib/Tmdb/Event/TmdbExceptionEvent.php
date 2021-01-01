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

use Psr\Http\Message\ResponseInterface;
use Tmdb\Exception\TmdbApiException;

class TmdbExceptionEvent extends StoppableEvent
{
    /**
     * @var TmdbApiException
     */
    private $exception;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * Constructor
     *
     * @param TmdbApiException $exception
     */
    public function __construct(TmdbApiException $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return TmdbApiException
     */
    public function getException(): TmdbApiException
    {
        return $this->exception;
    }

    /**
     * @return bool
     */
    public function hasResponse(): bool
    {
        return null !== $this->response;
    }

    /**
     * @return ResponseInterface|null
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }
}
