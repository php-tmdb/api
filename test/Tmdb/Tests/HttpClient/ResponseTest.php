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
namespace Tmdb\Tests\HttpClient;

use Tmdb\Common\ParameterBag;
use Tmdb\HttpClient\Response;
use Tmdb\Tests\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @test
     */
    public function doesSetGetCode()
    {
        $response = new Response();
        $response->setCode('/');

        $this->assertEquals('/', $response->getCode());
    }

    /**
     * @test
     */
    public function doesSetGetHeaders()
    {
        $response = new Response();
        $response->setHeaders(new ParameterBag([
            'X-Test' => '123'
        ]));

        $this->assertEquals('123', $response->getHeaders()->get('X-Test'));
    }
}
