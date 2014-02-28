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
namespace Tmdb\Tests\Repository;

class ListRepositoryTest extends TestCase
{
    const LIST_ID  = '509ec17b19c2950a0600050d';
    const MOVIE_ID = 150;

    /**
     * @test
     */
    public function shouldLoadList()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->load(self::LIST_ID);
    }

    /**
     * @test
     */
    public function shouldGetItemStatus()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getItemStatus(self::LIST_ID, self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldCreateList()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->createList('list-name', 'list-description');
    }

    /**
     * @test
     */
    public function shouldAdd()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->add('list-id', 'movie-id');
    }

    /**
     * @test
     */
    public function shouldRemove()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->remove('list-id', 'movie-id');
    }

    /**
     * @test
     */
    public function shouldDeleteList()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->deleteList('list-id');
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
