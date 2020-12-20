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

namespace Tmdb\Event;

use Exception;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
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
        $this->eventDispatcher->dispatch(new BeforeRequestEvent($event->getRequest()));

        if ($event->isPropagationStopped() && $event->hasResponse()) {
            return $event->getResponse();
        }

        $response = $this->sendRequest($event);
        $event->setResponse($response);
var_dump($response);exit;
        // Possibility to cache the request
        $this->eventDispatcher->dispatch(new ResponseEvent($response, $event->getRequest()));

        return $response;
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
