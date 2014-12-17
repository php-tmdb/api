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

class TmdbApiExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testConstruct()
    {
        $exception = new TmdbApiException(1, 'code');

        $this->assertEquals(1, $exception->getCode());
        $this->assertEquals('code', $exception->getMessage());
    }
}
