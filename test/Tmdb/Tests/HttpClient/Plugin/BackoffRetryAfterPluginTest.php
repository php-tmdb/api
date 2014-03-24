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

use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use Tmdb\HttpClient\Plugin\BackoffRetryAfterPlugin;
use Tmdb\Tests\TestCase;

class BackoffRetryAfterPluginTest extends TestCase
{
    /**
     * @test
     */
    public function shouldAddToken()
    {
        /**
         * @var Request $request
         */
        $request  = new Request('/', '');
        $response = new Response('429', array('Retry-After' => 8));

        $plugin = self::getMethod('getDelay');
        $delay  = $plugin->invokeArgs(new BackoffRetryAfterPlugin(), array(0, $request, $response));

        $this->assertEquals(8, $delay);
    }

    /**
     * Make sure we can access the protected method
     *
     * @param $name
     * @return \ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('Tmdb\HttpClient\Plugin\BackoffRetryAfterPlugin');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}
