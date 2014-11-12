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
namespace Tmdb\Tests\Model\Tv;

use Tmdb\Common\ObjectHydrator;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Tests\Model\TestCase;

class ExternalIdsTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $data = [
            'imdb_id'      => 'tt0903747',
            'freebase_id'  => '/en/breaking_bad',
            'freebase_mid' => '/m/03d34x8',
            'id'           => 1396,
            'tvdb_id'      => 81189,
            'tvrage_id'    => 18164,
        ];

        $hydrator = new ObjectHydrator();

        $object = $hydrator->hydrate(new ExternalIds(), $data);

        $this->assertEquals('tt0903747', $object->getImdbId());
        $this->assertEquals('/en/breaking_bad', $object->getFreebaseId());
        $this->assertEquals('/m/03d34x8', $object->getFreebaseMid());
        $this->assertEquals(1396, $object->getId());
        $this->assertEquals(81189, $object->getTvdbId());
        $this->assertEquals(18164, $object->getTvrageId());
    }
}
