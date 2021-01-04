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
 * @version 4.0.0
 */

namespace Tmdb\Event\Listener;

use Http\Client\Common\Plugin\CachePlugin;
use Http\Promise\FulfilledPromise;
use Psr\Cache\CacheItemPoolInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\ResponseEvent;
use Tmdb\Exception\TmdbApiException;
use Tmdb\HttpClient\HttpClient;

/**
 * As a shortcut for time being we make use of the php-http/cache-plugin.
 *
 * This is a little hacky, but I just wanna get 4.0 pushed ASAP. At a later stage we will review this again.
 *
 * Class Psr6CachedRequestListener
 * @package Tmdb\Event\Listener
 */
class Psr6CachedRequestListener extends RequestListener
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * @var array
     */
    private $options;

    /**
     * @var CachePlugin
     */
    private $httpCachePlugin;

    /**
     * Psr6CachedRequestListener constructor.
     *
     * @param HttpClient $httpClient
     * @param EventDispatcherInterface $eventDispatcher
     * @param CacheItemPoolInterface $cache
     * @param StreamFactoryInterface $streamFactory
     * @param array $options
     * @param array $pluginOptions
     */
    public function __construct(
        HttpClient $httpClient,
        EventDispatcherInterface $eventDispatcher,
        CacheItemPoolInterface $cache,
        StreamFactoryInterface $streamFactory,
        array $options = [],
        array $pluginOptions = []
    ) {
        parent::__construct($httpClient, $eventDispatcher);

        $this->cache = $cache;
        $this->streamFactory = $streamFactory;
        $this->options = $options;
        $this->httpCachePlugin = CachePlugin::serverCache($this->cache, $this->streamFactory, $pluginOptions);
    }

    /**
     * Add the API token to the headers.
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        // Preparation of request parameters / Possibility to use for logging and caching etc.
        $beforeRequestEvent = new BeforeRequestEvent($event->getRequest());
        $this->eventDispatcher->dispatch($beforeRequestEvent);

        $event->setRequest($beforeRequestEvent->getRequest());

        if ($beforeRequestEvent->isPropagationStopped() && $beforeRequestEvent->hasResponse()) {
            $event->setResponse($beforeRequestEvent->getResponse());
            return;
        }

        $cachedResponse = true;

        try {
            $response = $this->httpCachePlugin->handleRequest(
                $event->getRequest(),
                function ($request) use ($beforeRequestEvent, &$cachedResponse) {
                    $cachedResponse = false;
                    $response = $this->sendRequest($beforeRequestEvent);

                    return new FulfilledPromise($response);
                },
                function () {
                } // we do not need the plugin to go back
            );

            $response->then(
                function ($result) use ($beforeRequestEvent) {
                    $beforeRequestEvent->setResponse($result);
                }
            );

            $response = $beforeRequestEvent->getResponse();
        } catch (ClientExceptionInterface $e) {
            $response = $this->handleClientException($e, $beforeRequestEvent->getRequest());
        }

        try {
            if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 600) {
                throw $this->responseExceptionFactory->createTmdbApiException(
                    $beforeRequestEvent->getRequest(),
                    $response
                );
            }

            $event->setRequest($beforeRequestEvent->getRequest());
            $event->setResponse($response);
        } catch (TmdbApiException $e) {
            $response = $this->handleTmdbApiException($e);
        }

        $response = $response->withHeader('X-TMDB-Cache', $cachedResponse ? 'HIT' : 'MISS');

        // Possibility to cache the request
        $this->eventDispatcher->dispatch(new ResponseEvent($response, $event->getRequest()));
    }
}
