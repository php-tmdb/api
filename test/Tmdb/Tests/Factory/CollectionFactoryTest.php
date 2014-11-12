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
namespace Tmdb\Tests\Factory;

use Tmdb\Factory\CollectionFactory;
use Tmdb\Model\Collection;

class CollectionFactoryTest extends TestCase
{
    /**
     * @var Collection
     */
    private $collection;

    public function setUp()
    {
        /**
         * @var CollectionFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('collection/get.json');

        $data['overview'] = 'external';

        /**
         * @var Collection $collection
         */
        $this->collection = $factory->create($data);
    }

    /**
     * @test
     */
    public function shouldConstructCollection()
    {
        $this->assertInstanceOf('Tmdb\Model\Collection', $this->collection);
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var CollectionFactory $factory
         */
        $factory = $this->getFactory();

        $class = new \stdClass();

        $factory->setMovieFactory($class);
        $factory->setImageFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getMovieFactory());
        $this->assertInstanceOf('stdClass', $factory->getImageFactory());
    }

    /**
     * @test
     */
    public function shouldBeAbleToCreateCollection()
    {
        $factory = $this->getFactory();

        $data = [
            ['id' => 1],
            ['id' => 2],
        ];

        $collection = $factory->createCollection($data);

        $this->assertEquals(2, count($collection));
    }

    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $this->assertInstanceOf('Tmdb\Model\Image\BackdropImage', $this->collection->getBackdropImage());
        $this->assertEquals('/qCECROwx3TRUEgoZv2Mz2D723QC.jpg', $this->collection->getBackdropPath());
        $this->assertEquals(10, $this->collection->getId());
        $this->assertEquals('external', $this->collection->getOverview());
        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $this->collection->getImages());
        $this->assertEquals('Star Wars Collection', $this->collection->getName());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->collection->getParts());
        $this->assertInstanceOf('Tmdb\Model\Image\PosterImage', $this->collection->getPosterImage());
        $this->assertEquals('/ghd5zOQnDaDW1mxO7R5fXXpZMu.jpg', $this->collection->getPosterPath());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\CollectionFactory';
    }
}
