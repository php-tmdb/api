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

use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Subscriber\Cache\CacheSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Common\ParameterBag;
use Tmdb\Event\BeforeSendRequestEvent;
use Tmdb\Event\TmdbEvents;
use Tmdb\HttpClient\Adapter\AdapterInterface;
use Tmdb\HttpClient\Plugin\AcceptJsonHeaderPlugin;
use Tmdb\HttpClient\Plugin\ApiTokenPlugin;
use Tmdb\HttpClient\Plugin\SessionTokenPlugin;
use Tmdb\SessionToken;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class HttpClient
 * @package Tmdb\HttpClient
 */
class HttpClient implements HttpClientInterface
{
    /**
     * @var AdapterInterface
     */
    private $adapter;

    protected $options  = array();
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
     * @param $queryParameters
     * @param $headers
     *
     * @return array
     */
    protected function prepareOptions($queryParameters = array(), $headers = null)
    {
        $this->options = new ParameterBag(array_merge(
            $this->options,
            [
                'base_url' => $this->base_url,
                'query'    => $queryParameters,
                'headers'  => !empty($headers) ? $headers : null
            ]
        ));

        return $this->options;
    }

    /**
     * {@inheritDoc}
     */
    public function get($path, array $queryParameters = array(), array $headers = null)
    {
        $this->prepareOptions($queryParameters, $headers);

        $event = new BeforeSendRequestEvent($this->options);
        $this->eventDispatcher->dispatch(TmdbEvents::BEFORE_REQUEST, $event);

        return $this->adapter->get($path, $this->options);
    }

    /**
     * {@inheritDoc}
     */
    public function post($path, $postBody, array $queryParameters = array(), array $headers = array())
    {
        $this->prepareOptions($queryParameters, $headers);

        $event = new BeforeSendRequestEvent($this->options);
        $this->eventDispatcher->dispatch(TmdbEvents::BEFORE_REQUEST, $event);

        return $this->adapter->post($path, $headers, $postBody, $queryParameters);
    }

    /**
     * @todo
     * {@inheritDoc}
     */
    public function postJson($path, $postBody, array $queryParameters = array(), array $headers = array())
    {
        return $this->post(
            $path,
            $postBody,
            $queryParameters,
            array_merge($headers, ['Content-Type' => 'application/json'])
        );
    }

    /**
     * Get the current base url
     *
     * @return null|string
     */
    public function getBaseUrl()
    {
        return $this->getClient()->getBaseUrl();
    }

    /**
     * Set the base url secure / insecure
     *
     * @param $url
     * @return HttpClientInterface
     */
    public function setBaseUrl($url)
    {
        return $this->getClient()->setBaseUrl($url);
    }

    /**
     * Add an subscriber to enable caching.
     *
     * @param  array             $parameters
     * @throws \RuntimeException
     */
    public function setCaching(array $parameters = array())
    {
        if (!class_exists('Doctrine\Common\Cache\FilesystemCache')) {
            //@codeCoverageIgnoreStart
            throw new \RuntimeException(
                'Could not find the doctrine cache library,
                have you added doctrine-cache to your composer.json?'
            );
            //@codeCoverageIgnoreEnd
        }

        CacheSubscriber::attach($this->client);
    }

    /**
     * Add an subscriber to enable logging.
     *
     * @param  array             $parameters
     * @throws \RuntimeException
     */
    public function setLogging(array $parameters = array())
    {
        if (!array_key_exists('logger', $parameters) && !class_exists('\Monolog\Logger')) {
            //@codeCoverageIgnoreStart
            throw new \RuntimeException(
                'Could not find any logger set and the monolog logger library was not found
                to provide a default, you have to  set a custom logger on the client or
                have you forgot adding monolog to your composer.json?'
            );
            //@codeCoverageIgnoreEnd
        } else {
            $logger = new \Monolog\Logger('php-tmdb-api');
            $logger->pushHandler(
                new \Monolog\Handler\StreamHandler(
                    $parameters['log_path'],
                    \Monolog\Logger::DEBUG
                )
            );
        }

        if (array_key_exists('logger', $parameters)) {
            $logger = $parameters['logger'];
        }

        $logPlugin = null;

//        if ($logger instanceof \Psr\Log\LoggerInterface) {
//            $logPlugin = new LogPlugin(
//                new PsrLogAdapter($logger),
//                MessageFormatter::SHORT_FORMAT
//            );
//        }
//
//        if (null !== $logPlugin) {
//            $this->addSubscriber($logPlugin);
//        }
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

    private function registerDefaultPlugins()
    {
        $apiTokenPlugin = new ApiTokenPlugin($this->options['token']);
        $this->addSubscriber($apiTokenPlugin);

        $acceptJsonHeaderPlugin = new AcceptJsonHeaderPlugin();
        $this->addSubscriber($acceptJsonHeaderPlugin);
    }
}
