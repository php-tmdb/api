<?php

namespace Tmdb\Formatter\Hydration;

use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Formatter\HydrationFormatterInterface;

class SimpleHydrationFormatter implements HydrationFormatterInterface
{
    public function formatBeforeEvent(BeforeHydrationEvent $beforeEvent): string
    {
        return sprintf(
            'Hydrating model "%s".',
            get_class($beforeEvent->getSubject())
        );
    }
}
