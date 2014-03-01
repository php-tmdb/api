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

use Guzzle\Common\Event;
use Guzzle\Http\Message\Request;
use Tmdb\HttpClient\Plugin\AdultFilterPlugin;
use Tmdb\Tests\TestCase;

class AdultFilterPluginTest extends TestCase
{
    /**
     * @test
     */
    public function shouldAddToken()
    {
        $request = new Request('GET', '/');

        $event   = new Event();
        $event['request'] = $request;

        $plugin = new AdultFilterPlugin(false);

        $plugin->onBeforeSend($event);

        $this->assertEquals('/?include_adult=false', $event['request']->getUrl());
    }
}
