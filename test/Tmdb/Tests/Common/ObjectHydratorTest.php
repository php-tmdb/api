<?php

use PHPUnit\Framework\TestCase;
use Tmdb\Common\ObjectHydrator;
use Tmdb\Model\AbstractModel;

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 4.0.0
 */
class ObjectHydratorTest extends TestCase
{
    /**
     * @test
     */
    public function canHydrateObject()
    {
        $objectHydrator = new ObjectHydrator();

        $subject = $objectHydrator->hydrate(
            new TestModel(),
            [
                'id' => 15,
                'name' => 'Michael'
            ]
        );

        $this->assertInstanceOf('TestModel', $subject);
        $this->assertEquals(15, $subject->getId());
        $this->assertEquals('Michael', $subject->getName());
    }

    /**
     *
     * @test
     */
    public function callingNonExistingMethodThrowsException()
    {
        $this->expectException(\Tmdb\Exception\RuntimeException::class);
        $objectHydrator = new ObjectHydrator();

        $objectHydrator->hydrate(new FailingTestModel(), ['lastname' => 'Roterman']);
    }
}

class TestModel extends AbstractModel
{
    static $properties = ['id', 'name'];
    private $id;
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}

class FailingTestModel extends AbstractModel
{
    static $properties = ['lastname'];
}
