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

namespace Tmdb\Event\Listener\Response;

use Http\Client\Common\Plugin\CachePlugin;
use Nyholm\Psr7\Stream;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\SimpleCache\CacheInterface;
use Tmdb\Client;
use Tmdb\Event\RequestEvent;

class LoadCachedPsr6ResponseListener
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
     * LoadResponseFromCacheListener constructor.
     * @param CacheItemPoolInterface $cache
     * @param StreamFactoryInterface $streamFactory
     * @param array $options
     */
    public function __construct(
        CacheItemPoolInterface $cache,
        StreamFactoryInterface $streamFactory,
        array $options = array()
    ) {
        $this->cache = $cache;
        $this->streamFactory = $streamFactory;
        $this->options = $options;
    }

    /**
     * Add the API token to the headers.
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        $httpCachePlugin = CachePlugin::serverCache($this->cache, $this->streamFactory, $this->options);
        $httpCachePlugin->handleRequest($event->getRequest());
        $event->setRequest(
            $event->getRequest()->withHeader('User-Agent', sprintf('php-tmdb/api (v%s)', Client::VERSION))
        );
    }
}
