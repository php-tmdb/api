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
namespace Tmdb\Tests\Factory\Movie;

use Tmdb\Factory\Movie\AlternativeTitleFactory;
use Tmdb\Model\Movie\AlternativeTitle;
use Tmdb\Tests\Factory\TestCase;

class AlternativeTitleFactoryTest extends TestCase
{

    /**
     * @test
     */
    public function shouldConstructAlternativeTitle()
    {
        /**
         * @var AlternativeTitleFactory $factory
         */
        $factory = $this->getFactory();
        $data = [
            'iso_3166_1' => 'nl',
            'title' => 'Kaas'
        ];

        /**
         * @var AlternativeTitle
         */
        $title = $factory->create($data);

        $this->assertInstanceOf('Tmdb\Model\Movie\AlternativeTitle', $title);
        $this->assertEquals('nl', $title->getIso31661());
        $this->assertEquals('Kaas', $title->getTitle());
    }

    /**
     * @test
     */
    public function shouldBeAbleToCreateCollection()
    {
        $factory = $this->getFactory();

        $data = [
            ['id' => 1],
            ['id' => 2],
        ];

        $collection = $factory->createCollection($data);

        $this->assertEquals(2, count($collection));
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\Movie\AlternativeTitleFactory';
    }
}
