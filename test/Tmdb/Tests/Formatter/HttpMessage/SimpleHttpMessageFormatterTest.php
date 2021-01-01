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
use Tmdb\Formatter\HttpMessage\SimpleHttpMessageFormatter;
use Tmdb\Tests\TestCase;

class SimpleHttpMessageFormatterTest extends TestCase
{
    /**
     * @test
     */
    public function testFormatter()
    {
        $formatter = new SimpleHttpMessageFormatter();

        $request = new Request('GET', 'https://www.test.com/abc');
        $response = new Response(200);
        $exception = new ConnectException('failed to connect', $request);

        $this->assertEquals('GET https://www.test.com/abc 1.1', $formatter->formatRequest($request));
        $this->assertEquals('200 OK 1.1', $formatter->formatResponse($response));
        $this->assertEquals('0 failed to connect', $formatter->formatClientException($exception));
    }
}
