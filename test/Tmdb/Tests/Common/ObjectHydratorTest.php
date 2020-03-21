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
class ObjectHydratorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function canHydrateObject()
    {
        $objectHydrator = new \Tmdb\Common\ObjectHydrator();

        $subject = $objectHydrator->hydrate(new TestModel(), [
            'id'   => 15,
            'name' => 'Michael'
        ]);

        $this->assertInstanceOf('TestModel', $subject);
        $this->assertEquals(15, $subject->getId());
        $this->assertEquals('Michael', $subject->getName());
    }

    /**
     * @expectedException \Tmdb\Exception\RuntimeException
     * @test
     */
    public function callingNonExistingMethodThrowsException()
    {
        $objectHydrator = new \Tmdb\Common\ObjectHydrator();

        $objectHydrator->hydrate(new FailingTestModel(), ['lastname' => 'Roterman']);
    }
}

class TestModel extends \Tmdb\Model\AbstractModel
{
    private $id;
    private $name;

    static $properties = ['id', 'name'];

    /**
     * @param  mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}

class FailingTestModel extends \Tmdb\Model\AbstractModel
{
    static $properties = ['lastname'];
}
