<?php

namespace Tmdb\Tests\Event\Listener;

use Nyholm\Psr7\Factory\Psr17Factory;
use Tmdb\Event\RequestEvent;

class FakeTestListener
{
    public function __invoke(RequestEvent $event)
    {
        $factory = new Psr17Factory();
        $response = $factory->createResponse(301, 'hello world');
        $event->setResponse($response);

        $event->stopPropagation();
    }
}
