<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Neil Daniels <neil.here@gmail.com>
 * @copyright (c) 2021, Neil Daniels
 * @version 4.0.0
 */

namespace Tmdb\Tests\Model\Watch;

use Tmdb\Common\ObjectHydrator;
use Tmdb\Model\Watch\Provider;
use Tmdb\Tests\Model\TestCase;

class ProviderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $data = [
            'iso_3166_1' => 'US',
            'id' => 337,
            'name' => 'Disney Plus',
            'logo_path' => '/dgPueyEdOwpQ10fjuhL2WYFQwQs.jpg',
            'display_priority' => 1,
            'type' => 'flatrate',
        ];

        $hydrator = new ObjectHydrator();

        /**
         * @var Release $object
         */
        $object = $hydrator->hydrate(new Provider(), $data);

        $this->assertEquals('US', $object->getIso31661());
        $this->assertEquals(337, $object->getId());
        $this->assertEquals('Disney Plus', $object->getName());
        $this->assertEquals('/dgPueyEdOwpQ10fjuhL2WYFQwQs.jpg', $object->getLogoPath());
        $this->assertEquals(1, $object->getDisplayPriority());
        $this->assertEquals('flatrate', $object->getType());
    }
}
