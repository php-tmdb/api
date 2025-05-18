<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Event\Listener;

use Psr\EventDispatcher\EventDispatcherInterface;
use Tmdb\Common\ObjectHydrator;
use Tmdb\Event\AfterHydrationEvent;
use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Event\HydrationEvent;
use Tmdb\Model\AbstractModel;

/**
 * Class RequestSubscriber.
 */
class HydrationListener
{
    private readonly \Tmdb\Common\ObjectHydrator $hydrator;

    /**
     * HydrationListener constructor.
     */
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
        $this->hydrator = new ObjectHydrator();
    }

    /**
     * Hydrate the subject with data.
     */
    public function __invoke(HydrationEvent $event): \Tmdb\Model\AbstractModel
    {
        $before = new BeforeHydrationEvent($event->getSubject(), $event->getData());
        $before->setLastRequest($event->getLastRequest());
        $before->setLastResponse($event->getLastResponse());

        $this->eventDispatcher->dispatch($before);

        if ($before->isPropagationStopped()) {
            return $before->getSubject();
        }

        $after = new AfterHydrationEvent($this->hydrateSubject($before), $before->getData());
        $after->setLastRequest($event->getLastRequest());
        $after->setLastResponse($event->getLastResponse());

        $this->eventDispatcher->dispatch($after);

        return $after->getSubject();
    }

    /**
     * Hydrate the subject.
     *
     * @return AbstractModel
     */
    public function hydrateSubject(HydrationEvent $event)
    {
        return $this->hydrator->hydrate($event->getSubject(), $event->getData());
    }
}
