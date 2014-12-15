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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tmdb\Exception\RuntimeException;

/**
 * Class RequestSubscriber
 * @package Tmdb\Event
 */
class RequestSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            TmdbEvents::REQUEST        => 'send',
        ];
    }

    public function send(RequestEvent $event)
    {
        // Preparation of request parameters / Possibility to use for logging and caching etc.
        $event->getDispatcher()->dispatch(TmdbEvents::BEFORE_REQUEST, $event);

        if ($event->isPropagationStopped() && $event->hasResponse()) {
            return $event->getResponse();
        }

        $response = $this->createResponse($event);
        $event->setResponse($response);

        // Possibility to cache the request
        $event->getDispatcher()->dispatch(TmdbEvents::AFTER_REQUEST, $event);

        return $response;
    }

    /**
     * Call upon the adapter to create an response object
     *
     * @param  RequestEvent $event
     * @throws \Exception
     */
    public function createResponse(RequestEvent $event)
    {
        try {
            switch ($event->getMethod()) {
                case 'GET':
                    return $event->getHttpClient()->getAdapter()->get($event->getRequest());
                case 'HEAD':
                    return $event->getHttpClient()->getAdapter()->head($event->getRequest());
                case 'POST':
                    return $event->getHttpClient()->getAdapter()->post($event->getRequest());
                case 'PUT':
                    return $event->getHttpClient()->getAdapter()->put($event->getRequest());
                case 'PATCH':
                    return $event->getHttpClient()->getAdapter()->patch($event->getRequest());
                case 'DELETE':
                    return $event->getHttpClient()->getAdapter()->delete($event->getRequest());
                default:
                    throw new RuntimeException(sprintf('Unkown request method "%s".', $event->getMethod()));
            }
        } catch (\Exception $e) {
            // @todo create an exception that extracts the error and reports it in a generic clear way
            throw $e;
        }
    }
}
