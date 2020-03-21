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

use Tmdb\Factory\ListFactory;
use Tmdb\Model\Lists;

class ListFactoryTest extends TestCase
{
    private $data;

    /**
     * @var Lists
     */
    private $lists;

    public function setUp() :void
    {
        $this->data = $this->loadByFile('lists/get.json');

        /**
         * @var ListFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var Lists $list
         */
        $this->lists = $factory->create($this->data);
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var ListFactory $factory
         */
        $factory = $this->getFactory();

        $class = new \stdClass();

        $factory->setImageFactory($class);
        $factory->setListItemFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getImageFactory());
        $this->assertInstanceOf('stdClass', $factory->getListItemFactory());
    }

    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $this->assertEquals('Travis Bell', $this->lists->getCreatedBy());
        $this->assertEquals('Here\'s my list of best picture winners for the Oscars. Thought it would be neat to see them all together. There\'s a lot of movies here I have never even heard of.', $this->lists->getDescription());
        $this->assertEquals(18, $this->lists->getFavoriteCount());
        $this->assertEquals('509ec17b19c2950a0600050d', $this->lists->getId());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->lists->getItems());
        $this->assertEquals(85, $this->lists->getItemCount());
        $this->assertEquals('en', $this->lists->getIso6391());
        $this->assertEquals('Best Picture Winners - The Academy Awards', $this->lists->getName());
        $this->assertEquals('/efBm2Nm2v5kQnO0w3hYcW6hVsJU.jpg', $this->lists->getPosterPath());
        $this->assertInstanceOf('Tmdb\Model\Image\PosterImage', $this->lists->getPosterImage());
    }

    /**
     * @test
     */
    public function shouldGetItemStatus()
    {
        /**
         * @var ListFactory $factory
         */
        $factory = $this->getFactory();

        $result = $factory->createItemStatus($this->loadByFile('lists/item_status.json'));

        $this->assertEquals('509ec17b19c2950a0600050d', $result->getId());
        $this->assertEquals(true, $result->getItemPresent());
    }

    /**
     * @test
     */
    public function shouldCreateList()
    {
        /**
         * @var ListFactory $factory
         */
        $factory = $this->getFactory();

        $result = $factory->createResultWithListId($this->loadByFile('lists/list_create.json'));

        $this->assertEquals(1, $result->getStatusCode());
        $this->assertEquals('Success', $result->getStatusMessage());
        $this->assertEquals('50941077760ee35e1500000c', $result->getListId());
    }

    /**
     * @test
     */
    public function shouldAddItemToList()
    {
        /**
         * @var ListFactory $factory
         */
        $factory = $this->getFactory();

        $result = $factory->createResult($this->loadByFile('lists/add.json'));

        $this->assertEquals(12, $result->getStatusCode());
        $this->assertEquals('The item/record was updated successfully', $result->getStatusMessage());
    }

    /**
     * @test
     */
    public function shouldRemoveItemFromList()
    {
        /**
         * @var ListFactory $factory
         */
        $factory = $this->getFactory();

        $result = $factory->createResult($this->loadByFile('lists/remove.json'));

        $this->assertEquals(12, $result->getStatusCode());
        $this->assertEquals('The item/record was updated successfully', $result->getStatusMessage());
    }

    /**
     * @test
     */
    public function shouldRemoveList()
    {
        /**
         * @var ListFactory $factory
         */
        $factory = $this->getFactory();

        $result = $factory->createResult($this->loadByFile('lists/list_delete.json'));

        $this->assertEquals(13, $result->getStatusCode());
        $this->assertEquals('The item/record was deleted successfully', $result->getStatusMessage());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\ListFactory';
    }
}
