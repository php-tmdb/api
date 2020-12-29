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

namespace Tmdb\Tests\Exception;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tmdb\Exception\TmdbApiException;

class TmdbApiExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testConstruct()
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'http://www.test.com');
        $response = $factory->createResponse(500, 'uh-oh');

        $exception = new TmdbApiException(1, 'code', $request, $response);

        $this->assertEquals(1, $exception->getCode());
        $this->assertEquals('code', $exception->getMessage());
        $this->assertInstanceOf(RequestInterface::class, $exception->getRequest());
        $this->assertInstanceOf(ResponseInterface::class, $exception->getResponse());

        $request = $factory->createRequest('GET', 'http://www.testing.com/foo/bar');
        $response = $factory->createResponse(418, 'I\'m a teapot');

        $exception->setRequest($request);
        $exception->setResponse($response);

        $this->assertEquals('/foo/bar', $exception->getRequest()->getUri()->getPath());
        $this->assertEquals(418, $exception->getResponse()->getStatusCode());
    }
}
