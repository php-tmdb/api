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
namespace Tmdb\Tests\Model\Movie;

use Tmdb\Common\ObjectHydrator;
use Tmdb\Model\Movie\Release;
use Tmdb\Tests\Model\TestCase;

class ReleaseTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $data = [
            'iso_3166_1'    => 'US',
            'certification' => 'R',
            'release_date'  => '1999-10-15',
            'primary'       => true
        ];

        $hydrator = new ObjectHydrator();

        /**
         * @var Release $object
         */
        $object = $hydrator->hydrate(new Release(), $data);

        $this->assertEquals('US', $object->getIso31661());
        $this->assertEquals('R', $object->getCertification());
        $this->assertEquals(new \DateTime('1999-10-15'), $object->getReleaseDate());
        $this->assertEquals(true, $object->getPrimary());
    }
}
