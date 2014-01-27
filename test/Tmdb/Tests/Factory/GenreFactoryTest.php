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

class GenreFactoryTest extends TestCase
{
    const GENRE_ID = 28;

    /**
     * @test
     */
    public function shouldConstructGenre()
    {
        $object = $this->loadByFile(
            'file.json'
        );

        $this->assertInstanceOf('Tmdb\Model\Genre', $object);
        $this->assertEquals('28', $object->getId());
        $this->assertEquals('Action', $object->getName());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\GenreFactory';
    }
}