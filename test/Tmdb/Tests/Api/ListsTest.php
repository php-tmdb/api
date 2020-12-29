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
 * @version 4.0.0
 */

namespace Tmdb\Tests\Api;

class ListsTest extends TestCase
{
    public const LIST_ID = '509ec17b19c2950a0600050d';
    public const MOVIE_ID = 150;

    /**
     * @test
     */
    public function shouldGetList()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getList(self::LIST_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/list/' . self::LIST_ID);
    }

    /**
     * @test
     */
    public function shouldCreateList()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->createList('name', 'description');
        $this->assertLastRequestIsWithPathAndMethod('/3/list', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'name' => 'name',
                'description' => 'description'
            ]
        );
    }

    /**
     * @test
     */
    public function shouldGetItemStatus()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getItemStatus(self::LIST_ID, self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/list/' . self::LIST_ID . '/item_status', 'GET');
        $this->assertRequestHasQueryParameters(['movie_id' => self::MOVIE_ID]);
    }

    /**
     * @test
     */
    public function shouldAddMediaToList()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->addMediaToList(self::LIST_ID, self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/list/' . self::LIST_ID . '/add_item', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'media_id' => self::MOVIE_ID
            ]
        );
    }

    /**
     * @test
     */
    public function shouldRemoveMediaFromList()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->removeMediaFromList(self::LIST_ID, self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/list/' . self::LIST_ID . '/remove_item', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'media_id' => self::MOVIE_ID
            ]
        );
    }

    /**
     * @test
     */
    public function shouldDeleteList()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->deleteList(self::LIST_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/list/' . self::LIST_ID, 'DELETE');
    }

    /**
     * @test
     */
    public function shouldClearList()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->clearList(self::LIST_ID, true);
        $this->assertLastRequestIsWithPathAndMethod('/3/list/' . self::LIST_ID . '/clear', 'POST');
        $this->assertRequestHasQueryParameters(
            [
                'confirm' => 'true'
            ]
        );
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Lists';
    }
}
