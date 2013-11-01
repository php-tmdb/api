<?php
/**
 * This file is part of the Wrike PHP API created by B-Found IM&S.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @package Wrike
 * @author Michael Roterman <michael@b-found.nl>
 * @copyright (c) 2013, B-Found Internet Marketing & Services
 * @version 0.0.1
 */

namespace Tmdb\HttpClient\Plugin;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tmdb\ApiToken;

class ApiTokenPlugin implements EventSubscriberInterface
{
    /**
     * @var \Tmdb\ApiToken
     */
    private $token;

    public function __construct(ApiToken $token)
    {
        $this->token = $token;
    }

    public static function getSubscribedEvents()
    {
        return array('request.before_send' => 'onBeforeSend');
    }

    public function onBeforeSend(Event $event)
    {
        $url = $event['request']->getUrl(true);

        $origionalQuery = $url->getQuery();
        $newQuery       = clone $origionalQuery;

        $newQuery->set('api_key', $this->token->getApiToken());

        $event['request']->setUrl($url->setQuery($newQuery));
    }
}