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
namespace Tmdb\Tests\Model\Common;

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Tests\Model\TestCase;

class GenericCollectionTest extends TestCase
{
    /**
     * @var GenericCollection
     */
    private $collection;

    public function setUp() :void
    {
        $this->collection = new GenericCollection([
            'id' => 1,
            'name' => 'Dave'
        ]);
    }

    /**
     * @test
     */
    public function shouldConstructGenericCollection()
    {
        $emptyArray = [];
        $dataArray  = ['id' => 1];

        $emptyConstructCollection  = new GenericCollection();
        $emptyCollection           = new GenericCollection($emptyArray);
        $dataCollection            = new GenericCollection($dataArray);

        $this->assertEquals($emptyArray, $emptyConstructCollection->toArray());
        $this->assertEquals($emptyArray, $emptyCollection->toArray());
        $this->assertEquals($dataArray, $dataCollection->toArray());
    }

    /**
     * @test
     */
    public function shouldBeArrayAccess()
    {
        $this->setUp();
        $this->assertEquals(true, isset($this->collection['id']));
        $this->assertEquals(1, $this->collection['id']);

        $this->collection['id'] = 2;
        $this->assertEquals(2, $this->collection['id']);

        unset($this->collection['id']);
        $this->assertEquals(1, count($this->collection));

        $this->collection['id'] = 1;
        $this->assertEquals(2, count($this->collection));
        $this->assertEquals(1, $this->collection['id']);
    }

    /**
     * @test
     */
    public function shouldBeIteratorAggregate()
    {
        $this->setUp();
        $this->assertInstanceOf('\ArrayIterator', $this->collection->getIterator());
    }

    /**
     * @test
     */
    public function shouldBeCountable()
    {
        $this->setUp();
        $this->assertEquals(2, count($this->collection));
    }

    /**
     * @test
     */
    public function shouldBeAbleToRemove()
    {
        $this->setUp();

        $this->assertEquals(2, count($this->collection));

        $this->collection->remove('id');

        $this->assertEquals(1, count($this->collection));
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetAndGet()
    {
        $this->setUp();

        $this->collection->set('id', 2);

        $this->assertEquals(2, $this->collection['id']);

        $object = new \stdClass();
        $object->id = 1;

        $hash   = spl_object_hash($object);

        $this->collection->set(null, $object);

        $this->assertEquals($object, $this->collection->get($hash));
        $this->assertEquals(3, count($this->collection));

        $retrievedObject = $this->collection->get($object);
        $this->assertEquals($object, $retrievedObject);

        $this->collection->remove($object);
        $this->assertEquals(2, count($this->collection));

        $keys = $this->collection->getKeys();
        $this->assertEquals(['id', 'name'], $keys);

        $this->assertEquals(true, $this->collection->hasKey('id'));

        $this->assertEquals('id', $this->collection->keySearch('id'));
        $this->assertEquals(false, $this->collection->keySearch('parent'));

        $this->collection->replace(['id' => 2]);
        $this->assertEquals(1, count($this->collection));
        $this->assertEquals(2, $this->collection->get('id'));

        $this->collection->merge(['id' => 1]);
        $this->assertEquals([2, 1], $this->collection->get('id'));

        $this->collection->set('id', 1);
        $this->collection->set('name', 'Dave');

        $this->assertEquals(['id' => 1, 'name' => 'Dave'], $this->collection->getAll());
        $this->assertEquals(['name' => 'Dave'], $this->collection->getAll(['name']));

        $this->collection->clear();
        $this->assertEquals(0, count($this->collection));
    }
}
