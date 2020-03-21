<?php
namespace Tmdb\Tests\Event;
use Tmdb\Common\ParameterBag;
use Tmdb\Event\RequestEvent;
use Tmdb\HttpClient\Request;

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
class RequestEventTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function isFunctional()
    {
        $requestEvent = new RequestEvent(new Request(
            '/',
            'POST',
            new ParameterBag(['query' => 'parameter']),
            new ParameterBag(['X-Monkey' => true]),
            new ParameterBag(['key' => 'value'])
        ));

        $this->assertEquals('/', $requestEvent->getPath());
        $this->assertEquals('parameter', $requestEvent->getParameters()->get('query'));
        $this->assertEquals(true, $requestEvent->getHeaders()->get('X-Monkey'));
        $this->assertEquals('value', $requestEvent->getBody()->get('key'));

        $request = new Request('/foo/bar');
        $requestEvent->setRequest($request);

        $this->assertEquals('/foo/bar', $requestEvent->getPath());
    }
}
