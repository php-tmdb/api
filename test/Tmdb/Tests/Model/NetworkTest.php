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
namespace Tmdb\Tests\Model;

use Tmdb\Common\ObjectHydrator;
use Tmdb\Model\Network;

class NetworkTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $data = [
            'id'      => 1,
            'name'  => 'name',
        ];

        $hydrator = new ObjectHydrator();

        $object = $hydrator->hydrate(new Network(), $data);

        $this->assertEquals(1, $object->getId());
        $this->assertEquals('name', $object->getName());
    }
}
