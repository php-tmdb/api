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
 * @version 0.0.1
 */

namespace Tmdb\HttpClient;

use Monolog\Logger;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Log\LogLevel;
use RuntimeException;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tmdb\ApiToken;
use Tmdb\Common\ParameterBag;
use Tmdb\Event\HydrationListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\TmdbEvents;
use Tmdb\Exception\ApiTokenMissingException;
use Tmdb\GuestSessionToken;
use Tmdb\SessionToken;

/**
 * Class HttpClient
 * @package Tmdb\HttpClient
 */
class HttpClient
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var ResponseInterface
     */
    private $lastResponse;

    /**
     * @var RequestInterface
     */
    private $lastRequest;

    /**
     * @var SessionToken|GuestSessionToken
     */
    private $sessionToken;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct(
        array $options = []
    ) {
        $this->options = $options;
//
//        $this->setAdapter($this->options['adapter']);
//        $this->processOptions();
    }

    protected function processOptions(): void
    {
        if ($sessionToken = $this->options['session_token']) {
            $this->setSessionToken($sessionToken);
        }

        $cache = $this->options['cache'];

        if ($cache['enabled']) {
            $this->setupCache($cache);
        }

        $log = $this->options['log'];

        if ($log['enabled']) {
            $this->setupLog($log);
        }
    }

    protected function setupCache(array $cache): void
    {
        if ($this->isDefaultAdapter()) {
//            $this->setDefaultCaching($cache);
        } elseif (null !== $subscriber = $cache['subscriber']) {
            $subscriber->setOptions($cache);
            $this->addSubscriber($subscriber);
        }
    }

    public function isDefaultAdapter(): bool
    {
        if (!class_exists('GuzzleHttp\Client')) {
            return false;
        }

        return ($this->getAdapter() instanceof GuzzleAdapter);
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param AdapterInterface $adapter
     * @return $this
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $adapter->registerSubscribers($this->getEventDispatcher());
        $this->adapter = $adapter;

        return $this;
    }

    /**
     * Add a subscriber
     *
     * @param EventSubscriberInterface $subscriber
     *
     * @return void
     */
    public function addSubscriber(EventSubscriberInterface $subscriber): void
    {
        if ($subscriber instanceof HttpClientEventSubscriber) {
            $subscriber->attachHttpClient($this);
        }

        $this->eventDispatcher->addSubscriber($subscriber);
    }

    protected function setupLog(array $log): void
    {
        if ($this->isDefaultAdapter()) {
            $this->setDefaultLogging($log);
        } elseif (null !== $subscriber = $log['subscriber']) {
            $subscriber->setOptions($log);
            $this->addSubscriber($subscriber);
        }
    }

    /**
     * Enable logging
     *
     * @param array $parameters
     * @return $this
     * @throws RuntimeException
     */
    public function setDefaultLogging(array $parameters)
    {
        if ($parameters['enabled']) {
            if (!class_exists('\Monolog\Logger')) {
                //@codeCoverageIgnoreStart
                throw new RuntimeException(
                    'Could not find any logger set and the monolog logger library was not found
                    to provide a default, you have to  set a custom logger on the client or
                    have you forgot adding monolog to your composer.json?'
                );
                //@codeCoverageIgnoreEnd
            }

            $logger = new Logger('php-tmdb-api');
            $logger->pushHandler($parameters['handler']);

            if ($this->getAdapter() instanceof GuzzleAdapter) {
                $middleware = new \Concat\Http\Middleware\Logger($logger);
                $middleware->setRequestLoggingEnabled(true);
                $middleware->setLogLevel(function ($response) {
                    return LogLevel::DEBUG;
                });

                $this->getAdapter()->getClient()->getConfig('handler')->push(
                    $middleware,
                    'tmdb-log'
                );
            }
        }

        return $this;
    }

    /**
     * Create the request object and send it out to listening events.
     *
     * @param $path
     * @param $method
     * @param array $parameters
     * @param array $headers
     * @param null $body
     *
     * @return array|string
     *
     * @psalm-return array<empty, empty>|string
     */
    private function send(string $path, string $method, array $parameters = [], array $headers = [], $body = null)
    {
        $request = $this->createRequest(
            $path,
            $method,
            $parameters,
            $headers,
            $body
        );

        $event = new RequestEvent($request);
        $this->getPsr14EventDispatcher()->dispatch($event);

        $this->lastResponse = $event->getResponse();

        if ($this->lastResponse instanceof ResponseInterface) {
            return $this->lastResponse;
        }

        return [];
    }

    /**
     * Create the request object
     *
     * @param string $path
     * @param string $method
     * @param array $parameters
     * @param array $headers
     * @param string|null $body
     * @return RequestInterface
     */
    private function createRequest($path, string $method, array $parameters = [], array $headers = [], $body = null)
    {
        if (!empty($parameters)) {
            ksort($parameters);
        }

        $uri = empty($parameters) ?
            sprintf('%s/%s', $this->options['base_uri'], $path):
            sprintf('%s/%s?%s', $this->options['base_uri'], $path, http_build_query($parameters));

        $request = $this->getPsr17RequestFactory()->createRequest(
            $method,
            $this->getPsr17UriFactory()->createUri($uri)
        );

        foreach ($headers as $key => $value) {
            $request = $request->withHeader($key, $value);
        }

        if ($body) {
            if (in_array($method, $this->getHttpMethodsWithoutBody())) {
                throw new \InvalidArgumentException(sprintf(
                    'Trying to create a request with body with invalid method "%s", it should not contain a body.',
                    $method
                ));
            }

            $stream = $this->getPsr17StreamFactory()->createStream($body);
            $request = $request->withBody($stream);
        }

//        $request = new Request();

//        $request
//            ->setPath($path)
//            ->setMethod($method)
//            ->setParameters(new ParameterBag((array)$parameters))
//            ->setHeaders(new ParameterBag((array)$headers))
//            ->setBody($body)
//            ->setOptions(new ParameterBag((array)$this->options));

        return $this->lastRequest = $request;
    }

    /**
     * {@inheritDoc}
     *
     * @return array|string
     *
     * @psalm-return array<empty, empty>|string
     */
    public function get(string $path, array $parameters = [], array $headers = [])
    {
        return $this->send($path, 'GET', $parameters, $headers);
    }

    /**
     * {@inheritDoc}
     *
     * @return array|string
     *
     * @psalm-return array<empty, empty>|string
     */
    public function post(string $path, $body, array $parameters = [], array $headers = [])
    {
        return $this->send($path, 'POST', $parameters, $headers, $body);
    }

    /**
     * {@inheritDoc}
     *
     * @return array|string
     *
     * @psalm-return array<empty, empty>|string
     */
    public function head($path, array $parameters = [], array $headers = [])
    {
        return $this->send($path, 'HEAD', $parameters, $headers);
    }

    /**
     * {@inheritDoc}
     *
     * @return array|string
     *
     * @psalm-return array<empty, empty>|string
     */
    public function put($path, $body = null, array $parameters = [], array $headers = [])
    {
        return $this->send($path, 'PUT', $parameters, $headers, $body);
    }

    /**
     * {@inheritDoc}
     *
     * @return array|string
     *
     * @psalm-return array<empty, empty>|string
     */
    public function patch($path, $body = null, array $parameters = [], array $headers = [])
    {
        return $this->send($path, 'PATCH', $parameters, $headers, $body);
    }

    /**
     * {@inheritDoc}
     *
     * @return array|string
     *
     * @psalm-return array<empty, empty>|string
     */
    public function delete(string $path, $body = null, array $parameters = [], array $headers = [])
    {
        return $this->send($path, 'DELETE', $parameters, $headers, $body);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return EventDispatcherInterface
     * @todo remove before 4.0
     */
    public function getEventDispatcher()
    {
        return $this->getPsr14EventDispatcher();
    }

    /**
     * @return RequestInterface|null
     */
    public function getLastRequest(): ?RequestInterface
    {
        return $this->lastRequest;
    }

    /**
     * @return ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    /**
     * Get the current base url
     *
     * @return null|string
     */
    public function getBaseUrl()
    {
        return $this->base_url;
    }

    /**
     * Set the base url secure / insecure
     *
     * @param $url
     * @return HttpClient
     */
    public function setBaseUrl($url)
    {
        $this->base_url = $url;

        return $this;
    }

    /**
     * Remove a subscriber
     *
     * @param EventSubscriberInterface $subscriber
     *
     * @return void
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber): void
    {
        if ($subscriber instanceof HttpClientEventSubscriber) {
            $subscriber->attachHttpClient($this);
        }

        $this->eventDispatcher->removeSubscriber($subscriber);
    }

    /**
     * @return GuestSessionToken|SessionToken
     */
    public function getSessionToken()
    {
        return $this->sessionToken;
    }

    /**
     * Add an subscriber to append the session_token to the query parameters.
     *
     * @param SessionToken $sessionToken
     *
     * @return void
     */
    public function setSessionToken(SessionToken $sessionToken): void
    {
        $sessionTokenPlugin = new SessionTokenPlugin($sessionToken);
        $this->addSubscriber($sessionTokenPlugin);

        $this->sessionToken = $sessionToken;
    }

    /**
     * Register the default plugins
     *
     * @return $this
     */
    public function registerDefaults()
    {
        return;
        if (!array_key_exists('token', $this->options)) {
            throw new ApiTokenMissingException('An API token was not configured, please configure the `token` option with an correct ApiToken() object.');
        }

        $requestSubscriber = new RequestListener();
        $this->addSubscriber($requestSubscriber);

        $hydrationSubscriber = new HydrationListener();
        $this->addSubscriber($hydrationSubscriber);

        $apiTokenPlugin = new ApiTokenPlugin(
            is_string($this->options['token']) ?
                new ApiToken($this->options['token']) :
                $this->options['token']
        );

        $this->addSubscriber($apiTokenPlugin);

        $acceptJsonHeaderPlugin = new AcceptJsonRequestListener();
        $this->addSubscriber($acceptJsonHeaderPlugin);

        $contentTypeHeaderPlugin = new ContentTypeJsonHeaderPlugin();
        $this->addSubscriber($contentTypeHeaderPlugin);

        $userAgentHeaderPlugin = new UserAgentHeaderPlugin();
        $this->addSubscriber($userAgentHeaderPlugin);

        return $this;
    }

    /**
     * Add an subscriber to enable caching.
     *
     * @param array $parameters
     * @return $this
     * @throws RuntimeException
     */
    public function setDefaultCaching(array $parameters)
    {
        if ($parameters['enabled']) {
            if (!class_exists('Doctrine\Common\Cache\CacheProvider')) {
                //@codeCoverageIgnoreStart
                throw new RuntimeException(
                    'Could not find the doctrine cache library,
                    have you added doctrine-cache to your composer.json?'
                );
                //@codeCoverageIgnoreEnd
            }

            $this->adapter->getClient()->getConfig('handler')->push(
                new CacheMiddleware(
                    new PrivateCacheStrategy(
                        new DoctrineCacheStorage(
                            $parameters['handler']
                        )
                    )
                ),
                'tmdb-cache'
            );
        }

        return $this;
    }

    public function getPsr14EventDispatcher() : EventDispatcherInterface
    {
        return $this->options['event_dispatcher']['adapter'];
    }

    /**
     * @return ClientInterface
     */
    public function getPsr18Client() : ClientInterface
    {
        return $this->options['http']['client'];
    }

    /**
     * @return RequestFactoryInterface
     */
    public function getPsr17RequestFactory() : RequestFactoryInterface
    {
        return $this->options['http']['request_factory'];
    }

    /**
     * @return ResponseFactoryInterface
     */
    public function getPsr17ResponseFactory() : ResponseFactoryInterface
    {
        return $this->options['http']['response_factory'];
    }

    /**
     * @return StreamFactoryInterface
     */
    public function getPsr17StreamFactory() : StreamFactoryInterface
    {
        return $this->options['http']['stream_factory'];
    }

    /**
     * @return UriFactoryInterface
     */
    public function getPsr17UriFactory() : UriFactoryInterface
    {
        return $this->options['http']['uri_factory'];
    }

    private function getHttpMethodsWithoutBody(): array
    {
        return [
            'GET',
            'DELETE',
            'TRACE',
            'OPTIONS',
            'HEAD'
        ];
    }
}
