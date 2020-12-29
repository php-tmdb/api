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

namespace Tmdb\Tests\Repository;

class ListRepositoryTest extends TestCase
{
    public const LIST_ID  = '509fb10819c29510bb000675';
    public const MOVIE_ID = 150;

    /**
     * @test
     */
    public function shouldLoadList()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->load(self::LIST_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/list/' . self::LIST_ID);
    }

    /**
     * @test
     */
    public function shouldGetItemStatus()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getItemStatus(self::LIST_ID, self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/list/' . self::LIST_ID . '/item_status', 'GET');
        $this->assertRequestHasQueryParameters(['movie_id' => self::MOVIE_ID]);
    }

    /**
     * @test
     */
    public function shouldCreateList()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->createList('list-name', 'list-description');
        $this->assertLastRequestIsWithPathAndMethod('/3/list', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'name' => 'list-name',
                'description' => 'list-description'
            ]
        );
    }

    /**
     * @test
     */
    public function shouldAdd()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->add(self::LIST_ID, self::MOVIE_ID);
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
    public function shouldRemove()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->remove(self::LIST_ID, self::MOVIE_ID);
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
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->deleteList(self::LIST_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/list/' . self::LIST_ID, 'DELETE');
    }

    /**
     * @test
     */
    public function shouldClearList()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->clearList(self::LIST_ID, true);
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

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\ListRepository';
    }
}
