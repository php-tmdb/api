<?php

declare(strict_types=1);

namespace Tmdb\Formatter;

use Tmdb\Event\BeforeHydrationEvent;

interface HydrationFormatterInterface
{
    public function formatBeforeEvent(BeforeHydrationEvent $beforeEvent): string;
}
