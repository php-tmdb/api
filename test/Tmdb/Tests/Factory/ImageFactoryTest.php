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
namespace Tmdb\Tests\Factory;

class ImageFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConstructGenres()
    {
        $this->assertEquals(true,true);
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\ImageFactory';
    }
}
