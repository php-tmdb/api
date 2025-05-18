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

namespace Tmdb\Event\Listener\Logger;

use Psr\Log\LoggerInterface;
use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Formatter\Hydration\SimpleHydrationFormatter;
use Tmdb\Formatter\HydrationFormatterInterface;

/**
 * Class LogHydrationListener.
 */
class LogHydrationListener
{
    private readonly \Tmdb\Formatter\HydrationFormatterInterface $formatter;

    /**
     * RequestListener constructor.
     *
     * @param bool $withData if true the context will contain the data used
     */
    public function __construct(
        private readonly LoggerInterface $logger,
        ?HydrationFormatterInterface $formatter = null,
        private readonly bool $withData = false,
    ) {
        $this->formatter = $formatter ?: new SimpleHydrationFormatter();
    }

    public function __invoke(BeforeHydrationEvent $event): void
    {
        $context = [];

        if ($this->withData) {
            $context['data'] = $event->getData();
            $context['data_size'] = mb_strlen(\GuzzleHttp\Utils::jsonEncode($event->getData()), 'UTF-8');
        }

        $this->logger->debug(
            $this->formatter->formatBeforeEvent($event),
            $context,
        );
    }
}
