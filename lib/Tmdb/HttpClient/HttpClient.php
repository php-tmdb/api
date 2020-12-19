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

use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\DoctrineCacheStorage;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Monolog\Logger;
use Psr\Log\LogLevel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\ApiToken;
use Tmdb\Common\ParameterBag;
use Tmdb\Event\HydrationSubscriber;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\RequestSubscriber;
use Tmdb\Event\TmdbEvents;
use Tmdb\Exception\ApiTokenMissingException;
use Tmdb\GuestSessionToken;
use Tmdb\HttpClient\Adapter\AdapterInterface;
use Tmdb\HttpClient\Adapter\GuzzleAdapter;
use Tmdb\HttpClient\Plugin\AcceptJsonHeaderPlugin;
use Tmdb\HttpClient\Plugin\ApiTokenPlugin;
use Tmdb\HttpClient\Plugin\ContentTypeJsonHeaderPlugin;
use Tmdb\HttpClient\Plugin\SessionTokenPlugin;
use Tmdb\HttpClient\Plugin\UserAgentHeaderPlugin;
use Tmdb\SessionToken;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class HttpClient
 * @package Tmdb\HttpClient
 */
class HttpClient
{
    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var Response
     */
    private $lastResponse;

    /**
     * @var Request
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
    )
    {
        $this->options         = $options;
        $this->eventDispatcher = $this->options['event_dispatcher'];

        $this->setAdapter($this->options['adapter']);
        $this->processOptions();
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function get(string $path, array $parameters = [], array $headers = []): string
    {
        return $this->send($path, 'GET', $parameters, $headers);
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function post(string $path, $body, array $parameters = [], array $headers = []): string
    {
        return $this->send($path, 'POST', $parameters, $headers, $body);
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function head($path, array $parameters = [], array $headers = []): string
    {
        return $this->send($path, 'HEAD', $parameters, $headers);
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function put($path, $body = null, array $parameters = [], array $headers = []): string
    {
        return $this->send($path, 'PUT', $parameters, $headers, $body);
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function patch($path, $body = null, array $parameters = [], array $headers = []): string
    {
        return $this->send($path, 'PATCH', $parameters, $headers, $body);
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function delete(string $path, $body = null, array $parameters = [], array $headers = []): string
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
     * @param  array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return EventDispatcher
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    /**
     * @return Request
     */
    public function getLastRequest(): Request
    {
        return $this->lastRequest;
    }

    /**
     * @return Response
     */
    public function getLastResponse(): Response
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
     * Create the request object and send it out to listening events.
     *
     * @param $path
     * @param $method
     * @param array  $parameters
     * @param array  $headers
     * @param null   $body
     *
     * @return array|string
     *
     * @psalm-return array<empty, empty>|string
     */
    private function send($path, string $method, array $parameters = [], array $headers = [], $body = null)
    {
        $request = $this->createRequest(
            $path,
            $method,
            $parameters,
            $headers,
            $body
        );

        $event = new RequestEvent($request);
        $this->eventDispatcher->dispatch($event, TmdbEvents::REQUEST);

        $this->lastResponse = $event->getResponse();

        if ($this->lastResponse instanceof Response) {
            return (string) $this->lastResponse->getBody();
        }

        return [];
    }

    /**
     * Create the request object
     *
     * @param $path
     * @param $method
     * @param  array   $parameters
     * @param  array   $headers
     * @param $body
     * @return Request
     */
    private function createRequest($path, $method, $parameters = [], $headers = [], $body)
    {
        $request =  new Request();

        $request
            ->setPath($path)
            ->setMethod($method)
            ->setParameters(new ParameterBag((array) $parameters))
            ->setHeaders(new ParameterBag((array) $headers))
            ->setBody($body)
            ->setOptions(new ParameterBag((array) $this->options))
        ;

        return $this->lastRequest = $request;
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
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param  AdapterInterface $adapter
     * @return $this
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $adapter->registerSubscribers($this->getEventDispatcher());
        $this->adapter = $adapter;

        return $this;
    }

    /**
     * Register the default plugins
     *
     * @return $this
     */
    public function registerDefaults()
    {
        if (!array_key_exists('token', $this->options)) {
            throw new ApiTokenMissingException('An API token was not configured, please configure the `token` option with an correct ApiToken() object.');
        }

        $requestSubscriber = new RequestSubscriber();
        $this->addSubscriber($requestSubscriber);

        $hydrationSubscriber = new HydrationSubscriber();
        $this->addSubscriber($hydrationSubscriber);

        $apiTokenPlugin = new ApiTokenPlugin(
            is_string($this->options['token']) ?
                new ApiToken($this->options['token']):
                $this->options['token']
        );

        $this->addSubscriber($apiTokenPlugin);

        $acceptJsonHeaderPlugin = new AcceptJsonHeaderPlugin();
        $this->addSubscriber($acceptJsonHeaderPlugin);

        $contentTypeHeaderPlugin = new ContentTypeJsonHeaderPlugin();
        $this->addSubscriber($contentTypeHeaderPlugin);

        $userAgentHeaderPlugin = new UserAgentHeaderPlugin();
        $this->addSubscriber($userAgentHeaderPlugin);

        return $this;
    }

    public function isDefaultAdapter(): bool
    {
        if (!class_exists('GuzzleHttp\Client')) {
            return false;
        }

        return ($this->getAdapter() instanceof GuzzleAdapter);
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
     * Add an subscriber to enable caching.
     *
     * @param  array             $parameters
     * @throws \RuntimeException
     * @return $this
     */
    public function setDefaultCaching(array $parameters)
    {
        if ($parameters['enabled']) {
            if (!class_exists('Doctrine\Common\Cache\CacheProvider')) {
                //@codeCoverageIgnoreStart
                throw new \RuntimeException(
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

    /**
     * Enable logging
     *
     * @param  array             $parameters
     * @throws \RuntimeException
     * @return $this
     */
    public function setDefaultLogging(array $parameters)
    {
        if ($parameters['enabled']) {
            if (!class_exists('\Monolog\Logger')) {
                //@codeCoverageIgnoreStart
                throw new \RuntimeException(
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
                $middleware->setLogLevel(function($response) {
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
}
