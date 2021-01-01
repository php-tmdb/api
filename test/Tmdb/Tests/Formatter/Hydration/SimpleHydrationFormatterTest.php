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

namespace Tmdb\Tests\Formatter\Hydration;

use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Formatter\Hydration\SimpleHydrationFormatter;
use Tmdb\Model\Movie;
use Tmdb\Tests\TestCase;

class SimpleHydrationFormatterTest extends TestCase
{
    /**
     * @test
     */
    public function testFormatter()
    {
        $formatter = new SimpleHydrationFormatter();
        $event = new BeforeHydrationEvent(new Movie(), ['id' => 123]);

        $this->assertEquals('Hydrating model "Tmdb\Model\Movie".', $formatter->formatBeforeEvent($event));
    }
}
