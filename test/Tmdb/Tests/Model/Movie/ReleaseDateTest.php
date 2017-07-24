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
 * @version 2.1.7
 */
namespace Tmdb\Tests\Model\Movie;

use Tmdb\Common\ObjectHydrator;
use Tmdb\Model\Movie\ReleaseDate;
use Tmdb\Tests\Model\TestCase;

class ReleaseDateTest  extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $data = [
            'iso_3166_1'    => 'US',
            'iso_639_1'     => 'en',
            'certification' => 'R',
            'note'          => 'Released only to IMAX screens',
            'release_date'  => '2013-09-06T00:00:00.000Z',
            'type'          => 3
        ];

        $hydrator = new ObjectHydrator();

        /**
         * @var ReleaseDate $object
         */
        $object = $hydrator->hydrate(new ReleaseDate(), $data);

        $this->assertEquals('US', $object->getIso31661());
        $this->assertEquals('en', $object->getIso6391());
        $this->assertEquals('R', $object->getCertification());
        $this->assertEquals('Released only to IMAX screens', $object->getNote());
        $this->assertEquals(new \DateTime('2013-09-06', new \DateTimeZone('UTC')), $object->getReleaseDate());
        $this->assertEquals(3, $object->getType());
    }
}
