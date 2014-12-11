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
namespace Tmdb\Tests\HttpClient\Plugin;

use GuzzleHttp\Message\Request;
use Tmdb\Common\ParameterBag;
use Tmdb\Event\BeforeSendRequestEvent;
use Tmdb\HttpClient\Plugin\SessionTokenPlugin;
use Tmdb\SessionToken;
use Tmdb\Tests\TestCase;

class SessionTokenPluginTest extends TestCase
{
    /**
     * @test
     */
    public function shouldAddToken()
    {
        $token   = new SessionToken('abcdef');
        $request = new Request('GET', '/');

        $parameterBag = new ParameterBag(['request' => $request]);
        $event        = new BeforeSendRequestEvent($parameterBag);

        $plugin = new SessionTokenPlugin($token);

        $plugin->onBeforeSend($event);

        $options = $event->getOptions();

        $this->assertEquals((string) $token, $options['query']['session_id']);
    }
}
