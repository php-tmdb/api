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

use Tmdb\ApiToken;
use Tmdb\Common\ParameterBag;
use Tmdb\HttpClient\Request;
use Tmdb\Tests\TestCase;

class RequestTest extends TestCase
{
    /**
     * @test
     */
    public function doesSetGetPath()
    {
        $request = new Request();
        $request->setPath('/');

        $this->assertEquals('/', $request->getPath());
    }

    /**
     * @test
     */
    public function doesSetGetParameters()
    {
        $request = new Request();
        $request->setParameters(new ParameterBag([
            'api_key' => new ApiToken('abcdef')
        ]));

        $this->assertEquals(new ApiToken('abcdef'), $request->getParameters()->get('api_key'));
    }

    /**
     * @test
     */
    public function doesSetGetOptions()
    {
        $request = new Request();
        $request->setOptions(new ParameterBag([
            'api_key' => new ApiToken('abcdef')
        ]));

        $this->assertEquals(new ApiToken('abcdef'), $request->getOptions()->get('api_key'));
    }

    /**
     * @test
     */
    public function doesSetGetBody()
    {
        $request = new Request();
        $request->setBody('ab');

        $this->assertEquals('ab', $request->getBody());
    }
}
