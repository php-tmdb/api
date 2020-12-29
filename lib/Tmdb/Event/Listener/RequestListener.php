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

namespace Tmdb\Event\Listener;

use Exception;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\ResponseEvent;
use Tmdb\HttpClient\HttpClient;

/**
 * Class RequestSubscriber
 * @package Tmdb\Event
 */
class RequestListener
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * RequestListener constructor.
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(HttpClient $httpClient, EventDispatcherInterface $eventDispatcher)
    {
        $this->httpClient = $httpClient;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param RequestEvent $event
     * @param string $eventName
     * @param EventDispatcherInterface $eventDispatcher
     *
     * @return ResponseInterface
     */
    public function __invoke(RequestEvent $event)
    {
        // Preparation of request parameters / Possibility to use for logging and caching etc.
        $beforeRequestEvent = new BeforeRequestEvent($event->getRequest());
        $this->eventDispatcher->dispatch($beforeRequestEvent);

        if ($beforeRequestEvent->isPropagationStopped() && $beforeRequestEvent->hasResponse()) {
            return $beforeRequestEvent->getResponse();
        }

        $response = $this->sendRequest($beforeRequestEvent);
        $event->setRequest($beforeRequestEvent->getRequest());
        $event->setResponse($response);

        // Possibility to cache the request
        $this->eventDispatcher->dispatch(new ResponseEvent($response, $event->getRequest()));
    }

    /**
     * Call upon the adapter to create an response object
     *
     * @param RequestEvent $event
     * @return ResponseInterface
     * @throws Exception
     */
    public function sendRequest(RequestEvent $event): ResponseInterface
    {
        return $this->httpClient->getPsr18Client()->sendRequest($event->getRequest());
    }
}
