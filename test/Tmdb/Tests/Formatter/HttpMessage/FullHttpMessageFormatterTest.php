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

namespace Tmdb\Tests\Formatter\HttpMessage;

use GuzzleHttp\Exception\ConnectException;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Response;
use Tmdb\Formatter\HttpMessage\FullHttpMessageFormatter;
use Tmdb\Tests\TestCase;

class FullHttpMessageFormatterTest extends TestCase
{
    /**
     * @test
     */
    public function testFormatter()
    {
        $formatter = new FullHttpMessageFormatter();

        $request = new Request('GET', 'https://www.test.com/abc');
        $response = new Response(200, ['X-Foo' => 'Bar']);
        $exception = new ConnectException('failed to connect', $request);

        $expectedRequest = <<<HEADER
GET /abc HTTP/1.1
Host: www.test.com


HEADER;

        $expectedResponse = <<<HEADER
HTTP/1.1 200 OK
X-Foo: Bar


HEADER;

        $this->assertEquals($expectedRequest, $formatter->formatRequest($request));
        $this->assertEquals($expectedResponse, $formatter->formatResponse($response));
        $this->assertEquals('0 failed to connect', $formatter->formatClientException($exception));
    }
}
