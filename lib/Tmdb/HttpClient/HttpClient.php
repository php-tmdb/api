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

use Doctrine\Common\Cache\FilesystemCache;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Subscriber\Cache\CacheStorage;
use GuzzleHttp\Subscriber\Cache\CacheSubscriber;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\ApiToken;
use Tmdb\Common\ParameterBag;
use Tmdb\Event\BeforeSendRequestEvent;
use Tmdb\Event\TmdbEvents;
use Tmdb\Exception\ApiTokenMissingException;
use Tmdb\Exception\RuntimeException;
use Tmdb\HttpClient\Adapter\AdapterInterface;
use Tmdb\HttpClient\Adapter\GuzzleAdapter;
use Tmdb\HttpClient\Plugin\AcceptJsonHeaderPlugin;
use Tmdb\HttpClient\Plugin\ApiTokenPlugin;
use Tmdb\HttpClient\Plugin\SessionTokenPlugin;
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

    private $eventDispatcher;

    /**
     * @var ParameterBag
     */
    protected $options;

    protected $base_url = null;

    /**
     * @var ResponseInterface
     */
    private $lastResponse;

    /**
     * @var RequestInterface
     */
    private $lastRequest;

    /**
     * Constructor
     *
     * @param $baseUrl
     * @param array            $options
     * @param AdapterInterface $adapter
     * @param EventDispatcher  $eventDispatcher
     */
    public function __construct(
        $baseUrl,
        array $options,
        AdapterInterface $adapter,
        EventDispatcher $eventDispatcher
    )
    {
        $this->base_url        = $baseUrl;
        $this->options         = $options;
        $this->adapter         = $adapter;
        $this->eventDispatcher = $eventDispatcher;

        $this->registerDefaultPlugins();
    }

    /**
     * {@inheritDoc}
     */
    public function get($path, array $parameters = [], array $headers = [])
    {
        $this->beforeRequest($path, 'GET', $parameters, $headers);

        return $this->adapter->get($path, $this->options);
    }

    /**
     * {@inheritDoc}
     */
    public function post($path, $body, array $parameters = [], array $headers = [])
    {
        $this->beforeRequest($path, 'POST', $parameters, $headers);

        return $this->adapter->post($path, $body, $this->options);
    }

    /**
     * {@inheritDoc}
     */
    public function head($path, array $parameters = [], array $headers = [])
    {
        $this->beforeRequest($path, 'HEAD', $parameters, $headers);

        return $this->adapter->head($path, $this->options);
    }

    /**
     * {@inheritDoc}
     */
    public function put($path, $body = null, array $parameters = [], array $headers = [])
    {
        $this->beforeRequest($path, 'PUT', $parameters, $headers);

        return $this->adapter->put($path, $body, $this->options);
    }

    /**
     * {@inheritDoc}
     */
    public function patch($path, $body = null, array $parameters = [], array $headers = [])
    {
        $this->beforeRequest($path, 'PATCH', $parameters, $headers);

        return $this->adapter->patch($path, $body, $this->options);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($path, $body = null, array $parameters = [], array $headers = [])
    {
        $this->beforeRequest($path, 'DELETE', $parameters, $headers);

        return $this->adapter->delete($path, $body, $this->options);
    }

    /**
     * Prepare the request and provides an event hook to add query parameters
     *
     * @param $path
     * @param $type
     * @param array $parameters
     * @param array $headers
     */
    private function beforeRequest($path, $type, array $parameters = [], array $headers = [])
    {
        $this->prepareOptions($parameters, $headers);

        $event = new BeforeSendRequestEvent($this->options);

        $event->setPath($path);
        $event->setType($type);

        $this->eventDispatcher->dispatch(TmdbEvents::BEFORE_REQUEST, $event);
    }

    /**
     * Add a subscriber
     *
     * @param EventSubscriberInterface $subscriber
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->eventDispatcher->addSubscriber($subscriber);
    }

    /**
     * Set the query parameters
     *
     * @param $parameters
     * @param $headers
     *
     * @return array
     */
    protected function prepareOptions(array $parameters, array $headers)
    {
        return $this->options = new ParameterBag(array_merge(
            (array) $this->options,
            [
                'base_url' => $this->base_url,
                'query'    => (array) $parameters,
                'headers'  => (array) $headers
            ]
        ));
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
     * Add an subscriber to enable caching.
     *
     * @param  array             $parameters
     * @throws \RuntimeException
     * @return $this
     */
    public function setCaching(array $parameters = [])
    {
        if (!class_exists('Doctrine\Common\Cache\FilesystemCache')) {
            //@codeCoverageIgnoreStart
            throw new \RuntimeException(
                'Could not find the doctrine cache library,
                have you added doctrine-cache to your composer.json?'
            );
            //@codeCoverageIgnoreEnd
        }

        if ($this->getAdapter() instanceof GuzzleAdapter) {
            CacheSubscriber::attach(
                $this->getAdapter()->getClient(),
                ['storage' => new CacheStorage(new FilesystemCache($parameters['path']))]
            );
        }

        return $this;
    }

    /**
     * Enable logging
     *
     * @param  array $parameters
     * @param  int   $level
     * @return $this
     */
    public function setLogging(array $parameters = [], $level = Logger::DEBUG)
    {
        $logger = null;

        if (!array_key_exists('logger', $parameters) && !class_exists('\Monolog\Logger')) {
            //@codeCoverageIgnoreStart
            throw new \RuntimeException(
                'Could not find any logger set and the monolog logger library was not found
                to provide a default, you have to  set a custom logger on the client or
                have you forgot adding monolog to your composer.json?'
            );
            //@codeCoverageIgnoreEnd
        } else {
            $logger = new Logger('php-tmdb-api');
            $logger->pushHandler(
                new StreamHandler(
                    $parameters['path'],
                    $level
                )
            );
        }

        if (array_key_exists('logger', $parameters)) {
            $logger = $parameters['logger'];
        }

        if (!$logger instanceof LoggerInterface) {
            throw new RuntimeException('The logger must be an instance of \Psr\Log\LoggerInterface');
        }

        if ($this->getAdapter() instanceof GuzzleAdapter) {
            $subscriber = new LogSubscriber($logger);
            $this->getAdapter()->getClient()->getEmitter()->attach($subscriber);
        } else {
            // @todo provide a sane default logger for other types
        }

        return $this;
    }

    /**
     * Add an subscriber to append the session_token to the query parameters.
     *
     * @param SessionToken $sessionToken
     */
    public function setSessionToken(SessionToken $sessionToken)
    {
        $sessionTokenPlugin = new SessionTokenPlugin($sessionToken);
        $this->addSubscriber($sessionTokenPlugin);
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
        $this->adapter = $adapter;

        return $this;
    }

    /**
     * Register the default plugins
     *
     * @return $this
     */
    private function registerDefaultPlugins()
    {
        if (!array_key_exists('token', $this->options)) {
            throw new ApiTokenMissingException('An API token was not configured, please configure the `token` option with an correct ApiToken() object.');
        }

        $apiTokenPlugin = new ApiTokenPlugin(
            is_string($this->options['token']) ?
                new ApiToken($this->options['token']):
                $this->options['token'])
        ;
        $this->addSubscriber($apiTokenPlugin);

        $acceptJsonHeaderPlugin = new AcceptJsonHeaderPlugin();
        $this->addSubscriber($acceptJsonHeaderPlugin);

        return $this;
    }

    /**
     * @return ParameterBag
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param  ParameterBag $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }
}
