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
namespace Tmdb\HttpClient\Plugin;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tmdb\Event\BeforeSendRequestEvent;
use Tmdb\Event\TmdbEvents;
use Tmdb\GuestSessionToken;
use Tmdb\SessionToken;

/**
 * Class SessionTokenPlugin
 * @package Tmdb\HttpClient\Plugin
 */
class SessionTokenPlugin implements EventSubscriberInterface
{
    /**
     * @var \Tmdb\SessionToken
     */
    private $token;

    public function __construct(SessionToken $token)
    {
        $this->token = $token;
    }

    public static function getSubscribedEvents()
    {
        return array(TmdbEvents::BEFORE_REQUEST => 'onBeforeSend');
    }

    public function onBeforeSend(BeforeSendRequestEvent $event)
    {
        $options = $event->getOptions();

        if ($this->token instanceof GuestSessionToken) {
            $options['query']['guest_session_id'] = $this->token->getToken();
        } else {
            $options['query']['session_id'] = $this->token->getToken();
        }
    }
}
