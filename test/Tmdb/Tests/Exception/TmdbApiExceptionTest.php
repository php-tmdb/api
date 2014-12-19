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
namespace Tmdb\Tests\Exception;

use Tmdb\Exception\TmdbApiException;
use Tmdb\HttpClient\Request;
use Tmdb\HttpClient\Response;

class TmdbApiExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testConstruct()
    {
        $exception = new TmdbApiException(1, 'code', new Request(), new Response());

        $this->assertEquals(1, $exception->getCode());
        $this->assertEquals('code', $exception->getMessage());
        $this->assertEquals(new Request(), $exception->getRequest());
        $this->assertEquals(new Response(), $exception->getResponse());

        $exception->setRequest(new Request('/bla'));
        $exception->setResponse(new Response(404));

        $this->assertEquals('/bla', $exception->getRequest()->getPath());
        $this->assertEquals(404, $exception->getResponse()->getCode());
    }
}
