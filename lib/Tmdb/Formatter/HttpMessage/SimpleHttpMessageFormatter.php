<?php

namespace Tmdb\Formatter\HttpMessage;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tmdb\Formatter\HttpMessageFormatterInterface;

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
