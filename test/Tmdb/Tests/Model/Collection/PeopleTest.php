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
namespace Tmdb\Tests\Model\Collection;

use Tmdb\Model\Collection\People;
use Tmdb\Model\Person;
use Tmdb\Tests\Model\TestCase;

class PeopleTest extends TestCase
{
    /**
     * @var People
     */
    private $collection;

    private $people = [
        ['id' => 1, 'name' => 'james blunt'],
        ['id' => 2, 'name' => 'afrojack']
    ];

    public function setUp() :void
    {
        $this->collection = new People();

        foreach ($this->people as $person) {
            $object = $this->hydrate(new Person(), $person);

            $this->collection->addPerson($object);
        }
    }

    /**
     * @test
     */
    public function shouldGetAndSet()
    {
        $this->assertEquals(count($this->people), count($this->collection->getPeople()));

        $this->assertEquals('james blunt', $this->collection->getPerson(1)->getName());
        $this->assertEquals(null, $this->collection->getPerson(3));
    }
}
