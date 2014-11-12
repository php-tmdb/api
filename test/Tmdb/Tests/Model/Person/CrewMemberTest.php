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
namespace Tmdb\Tests\Model\Person;

use Tmdb\Common\ObjectHydrator;
use Tmdb\Model\Person\CrewMember;
use Tmdb\Tests\Model\TestCase;

class CrewMemberTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $data = [
            'id'           => 7477,
            'name'         => 'John King',
            'department'   => 'Sound',
            'job'          => 'Original Music Composer',
            'profile_path' => null
        ];

        $hydrator = new ObjectHydrator();

        $object = $hydrator->hydrate(new CrewMember(), $data);

        $this->assertEquals(7477, $object->getId());
        $this->assertEquals('John King', $object->getName());
        $this->assertEquals('Sound', $object->getDepartment());
        $this->assertEquals('Original Music Composer', $object->getJob());
        $this->assertEquals(null, $object->getProfilePath());
    }
}
