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

use Exception;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\HttpClientExceptionEvent;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\ResponseEvent;
use Tmdb\Event\TmdbExceptionEvent;
use Tmdb\Exception\Factory\ResponseExceptionFactory;
use Tmdb\Exception\TmdbApiException;
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
    protected $eventDispatcher;

    /**
     * @var ResponseExceptionFactory
     */
    protected $responseExceptionFactory;

    /**
     * RequestListener constructor.
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(HttpClient $httpClient, EventDispatcherInterface $eventDispatcher)
    {
        $this->httpClient = $httpClient;
        $this->eventDispatcher = $eventDispatcher;
        $this->responseExceptionFactory = new ResponseExceptionFactory();
    }

    /**
     * @param RequestEvent $event
     * @return void
     * @throws Exception
     * @throws TmdbApiException
     * @throws ClientExceptionInterface
     */
    public function __invoke(RequestEvent $event)
    {
        // Preparation of request parameters / Possibility to use for logging and caching etc.
        $beforeRequestEvent = new BeforeRequestEvent($event->getRequest());
        $this->eventDispatcher->dispatch($beforeRequestEvent);

        $event->setRequest($beforeRequestEvent->getRequest());

        if ($beforeRequestEvent->isPropagationStopped() && $beforeRequestEvent->hasResponse()) {
            $event->setResponse($beforeRequestEvent->getResponse());
            return;
        }

        try {
            $response = $this->sendRequest($beforeRequestEvent);
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

        // Possibility to cache the request
        $this->eventDispatcher->dispatch(new ResponseEvent($response, $event->getRequest()));
    }

    /**
     * Call upon the adapter to create an response object
     *
     * @param RequestEvent $event
     * @return ResponseInterface
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function sendRequest(RequestEvent $event): ResponseInterface
    {
        return $this->httpClient->getPsr18Client()->sendRequest($event->getRequest());
    }

    /**
     * @param ClientExceptionInterface $e
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    protected function handleClientException(
        ClientExceptionInterface $e,
        RequestInterface $request
    ): ResponseInterface {
        // In the event of failures, you can recover certain exceptions.
        $exceptionEvent = new HttpClientExceptionEvent($e, $request);

        $this->eventDispatcher->dispatch($exceptionEvent);

        if (!$exceptionEvent->isPropagationStopped() || !$exceptionEvent->hasResponse()) {
            throw $e;
        }

        return $exceptionEvent->getResponse();
    }

    /**
     * @param TmdbApiException $e
     * @return ResponseInterface
     * @throws TmdbApiException
     */
    protected function handleTmdbApiException(TmdbApiException $e): ResponseInterface
    {
        // In the event of failures, you can recover certain exceptions.
        $exceptionEvent = new TmdbExceptionEvent($e);

        $this->eventDispatcher->dispatch($exceptionEvent);

        if (!$exceptionEvent->isPropagationStopped() || !$exceptionEvent->hasResponse()) {
            throw $e;
        }

        return $exceptionEvent->getResponse();
    }
}
