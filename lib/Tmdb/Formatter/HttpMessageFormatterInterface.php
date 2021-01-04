<?php

namespace Tmdb\Formatter;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpMessageFormatterInterface
{
    /**
     * @param RequestInterface $request
     * @return string
     */
    public function formatRequest(RequestInterface $request): string;

    /**
     * @param ResponseInterface $response
     * @return string
     */
    public function formatResponse(ResponseInterface $response): string;

    /**
     * @param ClientExceptionInterface $exception
     * @return string
     */
    public function formatClientException(ClientExceptionInterface $exception): string;
}
