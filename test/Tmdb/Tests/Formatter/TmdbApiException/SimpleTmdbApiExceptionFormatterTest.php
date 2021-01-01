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

namespace Tmdb\Tests\Formatter\TmdbApiException;

use Tmdb\Exception\TmdbApiException;
use Tmdb\Formatter\TmdbApiException\SimpleTmdbApiExceptionFormatter;
use Tmdb\Tests\TestCase;

class SimpleTmdbApiExceptionFormatterTest extends TestCase
{
    /**
     * @test
     */
    public function testFormatter()
    {
        $formatter = new SimpleTmdbApiExceptionFormatter();

        $this->assertEquals('7 key invalid', $formatter->formatApiException(
            new TmdbApiException(7, 'key invalid')
        ));
    }
}
