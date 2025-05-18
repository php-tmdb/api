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

namespace Tmdb\HttpClient;

use InvalidArgumentException;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use RuntimeException;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Token\Session\GuestSessionToken;
use Tmdb\Token\Session\SessionToken;

/**
 * Class HttpClient.
 */
class HttpClient
{
    private ?\Psr\Http\Message\ResponseInterface $lastResponse = null;

    private ?\Psr\Http\Message\MessageInterface $lastRequest = null;

    /**
     * @var SessionToken|GuestSessionToken|null
     */
    private $sessionToken;

    /**
     * Constructor.
     */
    public function __construct(protected array $options = [])
    {
    }

    /**
     * Create the request object and send it out to listening events.
     *
     *
     * @return ResponseInterface
     */
    public function send(string $path, string $method, array $parameters = [], array $headers = [], $body = null)
    {
        $request = $this->createRequest(
            $path,
            $method,
            $parameters,
            $headers,
            $body,
        );

        $event = new RequestEvent($request, $this->sessionToken ?? null);
        $this->getPsr14EventDispatcher()->dispatch($event);

        $this->lastResponse = $event->getResponse();

        if ($this->lastResponse instanceof ResponseInterface) {
            return $this->lastResponse;
        }

        throw new RuntimeException(\sprintf('Expected an instance of a "%s", have you configured the event dispatcher for listener "%s" correctly for handling the "%s" event?', ResponseInterface::class, RequestListener::class, RequestEvent::class));
    }

    /**
     * Create the PSR-7 request object by making use of the PSR-17 factories.
     *
     * @param string|null $body
     *
     * @return RequestInterface
     */
    private function createRequest(
        string $path,
        string $method,
        array $parameters = [],
        array $headers = [],
        $body = null,
    ) {
        if ($parameters !== []) {
            ksort($parameters);
        }

        $uri = $parameters === [] ?
            \sprintf('%s/%s', $this->options['base_uri'], $path) :
            \sprintf('%s/%s?%s', $this->options['base_uri'], $path, http_build_query($parameters));

        $request = $this->getPsr17RequestFactory()->createRequest(
            $method,
            $this->getPsr17UriFactory()->createUri($uri),
        );

        if ($headers !== []) {
            ksort($headers);
        }

        foreach ($headers as $key => $value) {
            $request = $request->withHeader($key, $value);
        }

        if ($body) {
            if (\in_array($method, $this->getHttpMethodsWithoutBody(), true)) {
                throw new InvalidArgumentException(\sprintf('Trying to create a request with body with invalid method "%s", it should not contain a body.', $method));
            }

            $stream = $this->getPsr17StreamFactory()->createStream($body);
            $request = $request->withBody($stream);
        }

        return $this->lastRequest = $request;
    }

    public function getPsr17RequestFactory(): RequestFactoryInterface
    {
        return $this->options['http']['request_factory'];
    }

    public function getPsr17UriFactory(): UriFactoryInterface
    {
        return $this->options['http']['uri_factory'];
    }

    public function getPsr17StreamFactory(): StreamFactoryInterface
    {
        return $this->options['http']['stream_factory'];
    }

    public function getPsr14EventDispatcher(): EventDispatcherInterface
    {
        return $this->options['event_dispatcher']['adapter'];
    }

    /**
     * @return array|mixed
     */
    public function getOptions(?string $key = null)
    {
        if ($key) {
            return $this->options[$key] ?? null;
        }

        return $this->options;
    }

    public function setOptions(array $options): HttpClient
    {
        $this->options = $options;

        return $this;
    }

    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->getPsr14EventDispatcher();
    }

    public function getLastRequest(): ?RequestInterface
    {
        return $this->lastRequest;
    }

    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    public function getPsr18Client(): ClientInterface
    {
        return $this->options['http']['client'];
    }

    public function getPsr17ResponseFactory(): ResponseFactoryInterface
    {
        return $this->options['http']['response_factory'];
    }

    /**
     * @return string[]
     */
    private function getHttpMethodsWithoutBody(): array
    {
        return [
            'GET',
            'DELETE',
            'TRACE',
            'OPTIONS',
            'HEAD',
        ];
    }
}
