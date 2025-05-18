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

namespace Tmdb\Event\Listener\Logger;

use Psr\Log\LoggerInterface;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\HttpClientExceptionEvent;
use Tmdb\Event\LoggableHttpEventInterface;
use Tmdb\Event\ResponseEvent;
use Tmdb\Formatter\HttpMessage\SimpleHttpMessageFormatter;
use Tmdb\Formatter\HttpMessageFormatterInterface;

/**
 * Class LogHttpMessageListener.
 */
class LogHttpMessageListener
{
    private readonly \Tmdb\Formatter\HttpMessageFormatterInterface $formatter;

    /**
     * LogHttpMessageListener constructor.
     */
    public function __construct(private readonly LoggerInterface $logger, ?HttpMessageFormatterInterface $formatter = null)
    {
        $this->formatter = $formatter ?: new SimpleHttpMessageFormatter();
    }

    public function __invoke(LoggableHttpEventInterface $event): void
    {
        if ($event instanceof BeforeRequestEvent) {
            $this->logRequest($event);
        }

        if ($event instanceof ResponseEvent) {
            $this->logResponse($event);
        }

        if ($event instanceof HttpClientExceptionEvent) {
            $this->logClientException($event);
        }
    }

    protected function logRequest(BeforeRequestEvent $event): void
    {
        if ($event->getRequest()->getBody() instanceof \Psr\Http\Message\StreamInterface) {
            $event->getRequest()->getBody()->rewind();
        }

        $context = [
            'length' => $event->getRequest()->getBody()->getSize(),
            'has_session_token' => $event->hasSessionToken(),
        ];

        $this->logger->info(
            \sprintf(
                'Sending request:' . PHP_EOL . '%s',
                $this->formatter->formatRequest($event->getRequest()),
            ),
            $context,
        );
    }

    protected function logResponse(ResponseEvent $event): void
    {
        $cacheHit = $event->getResponse()->hasHeader('X-TMDB-Cache')
            && 'HIT' === $event->getResponse()->getHeaderLine('X-TMDB-Cache');

        $context = [
            'status_code' => $event->getResponse()->getStatusCode(),
            'length' => $event->getResponse()->getBody()->getSize(),
            'cached' => $cacheHit,
        ];

        $format = 'Received response:' . PHP_EOL . '%s';

        if ($cacheHit) {
            $format = 'Obtained cached response ' . PHP_EOL . '%s';
        }

        $this->logger->info(
            \sprintf(
                $format,
                $this->formatter->formatResponse($event->getResponse()),
            ),
            $context,
        );
    }

    protected function logClientException(HttpClientExceptionEvent $event): void
    {
        $context = [
            'request' => $event->getRequest()->getUri()->__toString(),
        ];

        $this->logger->critical(
            \sprintf(
                'Critical http client error:' . PHP_EOL . '%s',
                $this->formatter->formatClientException($event->getException()),
            ),
            $context,
        );
    }
}
