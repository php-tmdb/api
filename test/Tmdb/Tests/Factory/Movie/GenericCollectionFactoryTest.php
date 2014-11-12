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
namespace Tmdb\Tests\Factory\Movie;

use Tmdb\Factory\Common\GenericCollectionFactory;
use Tmdb\Model\AbstractModel;
use Tmdb\Tests\Factory\TestCase;

class GenericCollectionFactoryTest extends TestCase
{

    /**
     * @test
     */
    public function shouldBeAbleToCreateCollection()
    {
        $factory = $this->getFactory();

        $data = [
            ['id' => 2],
            ['id' => 2],
        ];

        $collection = $factory->create($data, new FakeClass());

        $this->assertEquals(2, count($collection));

        foreach ($collection as $item) {
            $this->assertEquals(2, $item->getId());
        }
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\Common\GenericCollectionFactory';
    }
}

class FakeClass extends AbstractModel
{
    public static $properties = ['id'];

    private $id;

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
}
