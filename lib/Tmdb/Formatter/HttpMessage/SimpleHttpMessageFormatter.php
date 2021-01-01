<?php

namespace Tmdb\Formatter\HttpMessage;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tmdb\Formatter\HttpMessageFormatterInterface;

/**
 * Borrowed this from our friends of `php-http/message`.
 * @see https://github.com/php-http/message/blob/master/src/Formatter/SimpleHttpMessageFormatter.php
 *
 * Class SimpleHttpMessageFormatter
 * @package Tmdb\Formatter\HttpMessage
 */
class SimpleHttpMessageFormatter implements HttpMessageFormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function formatRequest(RequestInterface $request): string
    {
        return sprintf(
            '%s %s %s',
            $request->getMethod(),
            $request->getUri()->__toString(),
            $request->getProtocolVersion()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function formatResponse(ResponseInterface $response): string
    {
        return sprintf(
            '%s %s %s',
            $response->getStatusCode(),
            $response->getReasonPhrase(),
            $response->getProtocolVersion()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function formatClientException(ClientExceptionInterface $exception): string
    {
        return sprintf(
            '%s %s',
            $exception->getCode(),
            $exception->getMessage()
        );
    }
}
