<?php

declare(strict_types=1);

namespace Tmdb\Formatter;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpMessageFormatterInterface
{
    public function formatRequest(RequestInterface $request): string;

    public function formatResponse(ResponseInterface $response): string;

    public function formatClientException(ClientExceptionInterface $exception): string;
}
