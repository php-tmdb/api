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
 * @version 2.1.10
 */

namespace Tmdb;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\RequestFactory;
use Monolog\Handler\StreamHandler;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tmdb\ApiToken as Token;
use Tmdb\HttpClient\Adapter\AdapterInterface;
use Tmdb\HttpClient\HttpClient;

/**
 * Client wrapper for TMDB
 * @package Tmdb
 */
class Client
{
    use ApiMethodsTrait;

    /** Client Version */
    public const VERSION = '4.0.0';

    /** Base API URI */
    public const TMDB_URI = 'api.themoviedb.org/3';

    /** Insecure schema */
    public const SCHEME_INSECURE = 'http';

    /** Secure schema */
    public const SCHEME_SECURE = 'https';

    /**
     * Stores the HTTP Client
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Store the options
     *
     * @var array
     */
    private $options = [];

    /**
     * Construct our client
     *
     * @param ApiToken $token
     * @param array $options
     */
    public function __construct(ApiToken $token, $options = [])
    {
        if ($options instanceof ConfigurationInterface) {
            $options = $options->all();
        }

        $this->configureOptions(array_replace(['token' => $token], (array)$options));
        $this->constructHttpClient();


        $ed = $this->getEventDispatcher();
        $requestListener = new \Tmdb\Event\Listener\RequestListener($this->getHttpClient(), $ed);
        $apiTokenListener = new \Tmdb\Event\Listener\Request\ApiTokenRequestListener($this->getToken());
        $acceptJsonListener = new \Tmdb\Event\Listener\Request\AcceptJsonRequestListener();
        $jsonContentTypeListener = new \Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener();

        $ed->addListener(\Tmdb\Event\BeforeRequestEvent::class, $apiTokenListener);
        $ed->addListener(\Tmdb\Event\BeforeRequestEvent::class, $acceptJsonListener);
        $ed->addListener(\Tmdb\Event\BeforeRequestEvent::class, $jsonContentTypeListener);
        $ed->addListener(\Tmdb\Event\RequestEvent::class, $requestListener);
    }

    /**
     * Configure options
     *
     * @param array $options
     * @return array
     */
    protected function configureOptions(array $options)
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'secure' => true,
            'host' => self::TMDB_URI,
            'base_uri' => null,
            'token' => null,
            'session_token' => null,
            'http' => function (OptionsResolver $optionsResolver) {
                $optionsResolver->setDefaults([
                    'client' => null,
                    'request_factory' => null,
                    'response_factory' => null,
                    'stream_factory' => null,
                    'uri_factory' => null,
                ]);
                $optionsResolver->setRequired([
                    'client',
                                                  'request_factory',
                                                  'response_factory',
                                                  'stream_factory',
                                                  'uri_factory'
                                              ]);
                $optionsResolver->setAllowedTypes('client', [ClientInterface::class, 'null']);
                $optionsResolver->setAllowedTypes('request_factory', [RequestFactoryInterface::class, 'null']);
                $optionsResolver->setAllowedTypes('response_factory', [ResponseFactoryInterface::class, 'null']);
                $optionsResolver->setAllowedTypes('stream_factory', [StreamFactoryInterface::class, 'null']);
                $optionsResolver->setAllowedTypes('uri_factory', [UriFactoryInterface::class, 'null']);
            },
            'event_dispatcher' => function (OptionsResolver $optionsResolver) {
                $optionsResolver->setDefaults([
                    'adapter' => null
                ]);
                $optionsResolver->setRequired(['adapter']);
                $optionsResolver->setAllowedTypes('adapter', [EventDispatcherInterface::class]);
            },
            'cache' => function (OptionsResolver $optionsResolver) {
                $optionsResolver->setDefaults([
                    'enabled' => false,
                    'adapter' => null,
                ]);

//                $optionsResolver->setAllowedTypes('adapter', [CacheInterface::class, 'null']);
            },
            'log' => function (OptionsResolver $optionsResolver) {
                $optionsResolver->setDefaults([
                    'enabled' => false,
                    'adapter' => null
                ]);
//                $optionsResolver->setAllowedTypes('adapter', [LoggerInterface::class, 'null']);
            },
        ]);

        $resolver->setRequired([
            'host',
            'token',
            'secure',
            'http',
            'event_dispatcher',
            'cache',
            'log'
        ]);

        $resolver->setAllowedTypes('host', ['string']);
        $resolver->setAllowedTypes('token', ['object']);
        $resolver->setAllowedTypes('secure', ['bool']);
        $resolver->setAllowedTypes('http', ['array']);
        $resolver->setAllowedTypes('event_dispatcher', ['array']);
        $resolver->setAllowedTypes('cache', ['array']);
        $resolver->setAllowedTypes('log', ['array']);
        $resolver->setAllowedTypes('session_token', ['object', 'null']);

        $this->options = $resolver->resolve($options);

        $this->postResolve($options);

        return $this->options;
    }

    /**
     * Post resolve
     *
     * @param array $options
     *
     * @return void
     */
    protected function postResolve(array $options = []): void
    {
        $this->options['http']['client'] = $this->options['http']['client'] ??
            Psr18ClientDiscovery::find();
        $this->options['http']['request_factory'] = $this->options['http']['request_factory'] ??
            Psr17FactoryDiscovery::findRequestFactory();
        $this->options['http']['response_factory'] = $this->options['http']['response_factory'] ??
            Psr17FactoryDiscovery::findResponseFactory();
        $this->options['http']['stream_factory'] = $this->options['http']['stream_factory'] ??
            Psr17FactoryDiscovery::findStreamFactory();
        $this->options['http']['uri_factory'] = $this->options['http']['uri_factory'] ??
            Psr17FactoryDiscovery::findUriFactory();

        $this->options['base_uri'] = sprintf(
            '%s://%s',
            $this->options['secure'] ? self::SCHEME_SECURE : self::SCHEME_INSECURE,
            $this->options['host']
        );

//        if (!$this->options['adapter']) {
//            $this->options['adapter'] = new GuzzleAdapter(
//                new \GuzzleHttp\Client()
//            );
//        }
//
//        $this->options['cache'] = $this->configureCacheOptions($options);
//        $this->options['log'] = $this->configureLogOptions($options);
    }

    /**
     * Configure caching
     *
     * @param array $options
     * @return array
     */
    protected function configureCacheOptions(array $options = [])
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'enabled' => true,
            'handler' => null,
            'subscriber' => null,
            'path' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-tmdb-api',
        ]);

        $resolver->setRequired([
            'enabled',
            'handler',
        ]);

        $resolver->setAllowedTypes('enabled', ['bool']);
        $resolver->setAllowedTypes('handler', ['object', 'null']);
        $resolver->setAllowedTypes('subscriber', ['object', 'null']);
        $resolver->setAllowedTypes('path', ['string', 'null']);

        $options = $resolver->resolve(array_key_exists('cache', $options) ? $options['cache'] : []);

        if ($options['enabled'] && !$options['handler']) {
            // @todo implement psr-16
//            $options['handler'] = new FilesystemCache($options['path']);
        }

        return $options;
    }

    /**
     * Configure logging
     *
     * @param array $options
     * @return array
     */
    protected function configureLogOptions(array $options = [])
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'enabled' => false,
            'level' => LogLevel::DEBUG,
            'handler' => null,
            'subscriber' => null,
            'path' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-tmdb-api.log',
        ]);

        $resolver->setRequired([
            'enabled',
            'level',
            'handler',
        ]);

        $resolver->setAllowedTypes('enabled', ['bool']);
        $resolver->setAllowedTypes('level', ['string']);
        $resolver->setAllowedTypes('handler', ['object', 'null']);
        $resolver->setAllowedTypes('path', ['string', 'null']);
        $resolver->setAllowedTypes('subscriber', ['object', 'null']);

        $options = $resolver->resolve(array_key_exists('log', $options) ? $options['log'] : []);

        if ($options['enabled'] && !$options['handler']) {
            $options['handler'] = new StreamHandler(
                $options['path'],
                $options['level']
            );
        }

        return $options;
    }

    /**
     * Construct the http client
     *
     * In case you are implementing your own adapter, the base url will be passed on through the options bag
     * at every call in the respective get / post methods etc. of the adapter.
     *
     * @return void
     */
    protected function constructHttpClient()
    {
        $hasHttpClient = (null !== $this->httpClient);

        $this->httpClient = new HttpClient($this->getOptions());

        if (!$hasHttpClient) {
            $this->httpClient->registerDefaults();
        }
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
     *
     * @return void
     */
    public function setOptions(array $options = []): void
    {
        $this->options = $this->configureOptions($options);
    }

    /**
     * @param SessionToken $sessionToken
     * @return $this
     */
    public function setSessionToken($sessionToken)
    {
        $this->options['session_token'] = $sessionToken;
        $this->reconstructHttpClient();

        return $this;
    }

    /**
     * Reconstruct the HTTP Client
     *
     * @return void
     */
    protected function reconstructHttpClient(): void
    {
        if (null !== $this->getHttpClient()) {
            $this->constructHttpClient();
        }
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param HttpClient $httpClient
     *
     * @return void
     */
    public function setHttpClient(HttpClient $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return SessionToken
     */
    public function getSessionToken()
    {
        return $this->options['session_token'];
    }

    /**
     * Get the API token
     *
     * @return Token
     */
    public function getToken()
    {
        return $this->options['token'];
    }

    /**
     * Get the adapter
     *
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->options['adapter'];
    }

    /**
     * Get the event dispatcher
     *
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher()
    {
        return $this->options['event_dispatcher']['adapter'];
    }

    /**
     * @param string $key
     *
     * @return array
     */
    public function getOption($key)
    {
        return array_key_exists($key, $this->options) ? $this->options[$key] : null;
    }
}
