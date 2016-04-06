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
    const LIST_ID  = '509fb10819c29510bb000675';
    const MOVIE_ID = 150;

    /**
     * @test
     */
    public function shouldLoadList()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/list/' . self::LIST_ID))
        ;

        $repository->load(self::LIST_ID);
    }

    /**
     * @test
     */
    public function shouldGetItemStatus()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/list/' . self::LIST_ID . '/item_status', ['movie_id' => self::MOVIE_ID]))
        ;

        $repository->getItemStatus(self::LIST_ID, self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldCreateList()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest('https://api.themoviedb.org/3/list', [], 'POST', [], ['name' => 'list-name', 'description' => 'list-description']))
        ;

        $repository->createList('list-name', 'list-description');
    }

    /**
     * @test
     */
    public function shouldAdd()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest('https://api.themoviedb.org/3/list/'.self::LIST_ID.'/add_item', [], 'POST', [], ['media_id' => self::MOVIE_ID]))
        ;

        $repository->add(self::LIST_ID, self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldRemove()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest('https://api.themoviedb.org/3/list/'.self::LIST_ID.'/remove_item', [], 'POST', [], ['media_id' => self::MOVIE_ID]))
        ;

        $repository->remove(self::LIST_ID, self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldDeleteList()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('delete')
            ->with($this->getRequest('https://api.themoviedb.org/3/list/' . self::LIST_ID, [], 'DELETE'))
        ;

        $repository->deleteList(self::LIST_ID);
    }

    /**
     * @test
     */
    public function shouldClearList()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest('https://api.themoviedb.org/3/list/'.self::LIST_ID.'/clear', ['confirm'=>'true'], 'POST'))
        ;

        $repository->clearList(self::LIST_ID, true);
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
