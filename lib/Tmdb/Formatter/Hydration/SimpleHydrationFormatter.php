<?php

declare(strict_types=1);

namespace Tmdb\Formatter\Hydration;

use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Formatter\HydrationFormatterInterface;

class SimpleHydrationFormatter implements HydrationFormatterInterface
{
    #[\Override]
    public function formatBeforeEvent(BeforeHydrationEvent $beforeEvent): string
    {
        return \sprintf(
            'Hydrating model "%s".',
            $beforeEvent->getSubject()::class,
        );
    }
}
