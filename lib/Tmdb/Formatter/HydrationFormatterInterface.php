<?php

namespace Tmdb\Formatter;

use Tmdb\Event\AfterHydrationEvent;
use Tmdb\Event\BeforeHydrationEvent;

interface HydrationFormatterInterface
{
    /**
     * @param BeforeHydrationEvent $beforeEvent
     * @return string
     */
    public function formatBeforeEvent(BeforeHydrationEvent $beforeEvent): string;
}
