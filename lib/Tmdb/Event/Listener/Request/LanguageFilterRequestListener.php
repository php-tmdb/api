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

namespace Tmdb\Event\Listener\Request;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tmdb\Event\RequestEvent;
use Tmdb\Helper\RequestQueryHelper;

class LanguageFilterRequestListener
{
    /**
     * @var string
     */
    private $language;

    /**
     * @var RequestQueryHelper
     */
    private $requestQueryHelper;

    /**
     * LanguageFilterRequestListener constructor.
     * @param string $language
     */
    public function __construct($language = 'en')
    {
        $this->language = $language;
        $this->requestQueryHelper = new RequestQueryHelper();
    }

    /**
     * Set the language filter.
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        $event->setRequest(
            $this->requestQueryHelper->withQuery($event->getRequest(), 'language', $this->language)
        );
    }
}
