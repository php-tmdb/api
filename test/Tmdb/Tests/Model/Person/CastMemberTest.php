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
use Tmdb\Model\Person\CastMember;
use Tmdb\Tests\Model\TestCase;

class CastMemberTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $data = [
            'id'           => 819,
            'name'         => 'Edward Norton',
            'character'    => 'The Narrator',
            'order'        => 0,
            'cast_id'      => 4,
            'profile_path' => '/588Hrov6wwM9WcU88nJHlw2iufN.jpg'
        ];

        $hydrator = new ObjectHydrator();

        $object = $hydrator->hydrate(new CastMember(), $data);

        $this->assertEquals(819, $object->getId());
        $this->assertEquals('Edward Norton', $object->getName());
        $this->assertEquals('The Narrator', $object->getCharacter());
        $this->assertEquals(0, $object->getOrder());
        $this->assertEquals(4, $object->getCastId());
        $this->assertEquals('/588Hrov6wwM9WcU88nJHlw2iufN.jpg', $object->getProfilePath());
    }
}
