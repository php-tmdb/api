<?php

namespace Tmdb\Formatter\HttpMessage;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tmdb\Formatter\HttpMessageFormatterInterface;

/**
 * Borrowed this from our friends of `php-http/message`.
 * @see https://github.com/php-http/message/blob/master/src/Formatter/FullHttpMessageFormatter.php
 *
 * Class FullHttpMessageFormatter
 * @package Tmdb\Formatter\HttpMessage
 */
class FullHttpMessageFormatter implements HttpMessageFormatterInterface
{
    /**
     * The maximum length of the body.
     *
     * @var int|null
     */
    private $maxBodyLength;

    /**
     * @param int|null $maxBodyLength
     */
    public function __construct($maxBodyLength = 1024)
    {
        $this->maxBodyLength = $maxBodyLength;
    }

    /**
     * {@inheritdoc}
     */
    public function formatRequest(RequestInterface $request): string
    {
        $message = sprintf(
            "%s %s HTTP/%s\n",
            $request->getMethod(),
            $request->getRequestTarget(),
            $request->getProtocolVersion()
        );

        foreach ($request->getHeaders() as $name => $values) {
            $message .= $name . ': ' . implode(', ', $values) . "\n";
        }

        return $this->addBody($request, $message);
    }

    /**
     * {@inheritdoc}
     */
    public function formatResponse(ResponseInterface $response): string
    {
        $message = sprintf(
            "HTTP/%s %s %s\n",
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        );

        foreach ($response->getHeaders() as $name => $values) {
            $message .= $name . ': ' . implode(', ', $values) . "\n";
        }

        return $this->addBody($response, $message);
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

    /**
     * Add the message body if the stream is seekable.
     *
     * @param MessageInterface $request
     * @param string $message
     *
     * @return string
     */
    private function addBody(MessageInterface $request, $message)
    {
        $message .= "\n";
        $stream = $request->getBody();
        if (!$stream->isSeekable() || 0 === $this->maxBodyLength) {
            // Do not read the stream
            return $message;
        }

        $data = $stream->__toString();
        $stream->rewind();

        // all non-printable ASCII characters and <DEL> except for \t, \r, \n
        if (preg_match('/([\x00-\x09\x0C\x0E-\x1F\x7F])/', $data)) {
            return $message . '[binary stream omitted]';
        }

        if (null === $this->maxBodyLength) {
            return $message . $data;
        }

        return $message . mb_substr($data, 0, $this->maxBodyLength);
    }
}
