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
namespace Tmdb\Tests\Api;

class ListsTest extends TestCase
{
    const LIST_ID = '509ec17b19c2950a0600050d';

    /**
     * @test
     */
    public function shouldGetList()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('list/' . self::LIST_ID);

        $api->getList(self::LIST_ID);
    }

    /**
     * @test
     */
    public function shouldCreateList()
    {
        $api = $this->getApiMock();
        $api->createList('name', 'description');
    }

    /**
     * @test
     */
    public function shouldGetItemStatus()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('list/' . self::LIST_ID . '/item_status');

        $api->getItemStatus(self::LIST_ID, 150);
    }

    /**
     * @test
     */
    public function shouldAddMediaToList()
    {
        $api = $this->getApiMock();
        $api->addMediaToList(self::LIST_ID, 150);
    }

    /**
     * @test
     */
    public function shouldRemoveMediaFromList()
    {
        $api = $this->getApiMock();
        $api->removeMediaFromList(self::LIST_ID, 150);
    }

    /**
     * @test
     */
    public function shouldDeleteList()
    {
        $api = $this->getApiMock();
        $api->deleteList(self::LIST_ID);
    }

    /**
     * @test
     */
    public function shouldClearList()
    {
        $api = $this->getApiMock();
        $api->clearList(self::LIST_ID, true);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Lists';
    }
}
