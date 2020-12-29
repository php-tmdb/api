<?php

namespace Tmdb\Event;

use Psr\EventDispatcher\StoppableEventInterface;

class StoppableEvent implements StoppableEventInterface
{
    protected $isPropagationStopped;

    public function isPropagationStopped(): bool
    {
        return (bool)$this->isPropagationStopped;
    }
}
