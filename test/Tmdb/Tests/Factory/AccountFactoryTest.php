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

use Tmdb\Factory\AccountFactory;
use Tmdb\Model\Account;
use Tmdb\Model\Collection\ResultCollection;

class AccountFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetAccount()
    {
        /**
         * @var AccountFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var Account $account
         */
        $account = $factory->create($this->loadByFile('account/get.json'));

        $this->assertEquals(36, $account->getId());
        $this->assertEquals(false, $account->getIncludeAdult());
        $this->assertEquals('US', $account->getIso31661());
        $this->assertEquals('en', $account->getIso6391());
        $this->assertEquals('John Doe', $account->getName());
        $this->assertEquals('johndoe', $account->getUsername());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $account->getAvatar());
    }

    /**
     * @test
     */
    public function shouldGetLists()
    {
        /**
         * @var AccountFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var ResultCollection $collection
         */
        $collection = $factory->createResultCollection($this->loadByFile('account/lists.json'), 'createListItem');

        $this->assertInstanceOf('Tmdb\Model\Collection\ResultCollection', $collection);
        $this->assertEquals(1, $collection->getPage());
        $this->assertEquals(1, $collection->getTotalPages());
        $this->assertEquals(15, $collection->getTotalResults());
    }

    /**
     * @test
     */
    public function shouldGetFavoriteMovies()
    {
        /**
         * @var AccountFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var ResultCollection $collection
         */
        $collection = $factory->createResultCollection($this->loadByFile('account/favorite_movies.json'), 'createMovie');

        $this->assertInstanceOf('Tmdb\Model\Collection\ResultCollection', $collection);
        $this->assertEquals(1, $collection->getPage());
        $this->assertEquals(2, $collection->getTotalPages());
        $this->assertEquals(34, $collection->getTotalResults());
    }

    /**
     * @test
     */
    public function shouldCreateStatus()
    {
        /**
         * @var AccountFactory $factory
         */
        $factory = $this->getFactory();

        $status = $factory->createStatusResult($this->loadByFile('account/favorite.json'));

        $this->assertEquals(12, $status->getStatusCode());
        $this->assertEquals('The item/record was updated successfully', $status->getStatusMessage());
    }

    /**
     * @test
     */
    public function shouldGetRatedMovies()
    {
        /**
         * @var AccountFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var ResultCollection $collection
         */
        $collection = $factory->createResultCollection($this->loadByFile('account/rated_movies.json'), 'createMovie');

        $this->assertInstanceOf('Tmdb\Model\Collection\ResultCollection', $collection);
        $this->assertEquals(1, $collection->getPage());
        $this->assertEquals(12, $collection->getTotalPages());
        $this->assertEquals(239, $collection->getTotalResults());
    }

    /**
     * @test
     */
    public function shouldGetMovieWatchlist()
    {
        /**
         * @var AccountFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var ResultCollection $collection
         */
        $collection = $factory->createResultCollection($this->loadByFile('account/movie_watchlist.json'), 'createMovie');

        $this->assertInstanceOf('Tmdb\Model\Collection\ResultCollection', $collection);
        $this->assertEquals(1, $collection->getPage());
        $this->assertEquals(4, $collection->getTotalPages());
        $this->assertEquals(67, $collection->getTotalResults());
    }

    /**
     * @test
     */
    public function shouldWatchlist()
    {
        /**
         * @var AccountFactory $factory
         */
        $factory = $this->getFactory();

        $status = $factory->createStatusResult($this->loadByFile('account/watchlist.json'));

        $this->assertEquals(1, $status->getStatusCode());
        $this->assertEquals('Success', $status->getStatusMessage());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\AccountFactory';
    }
}
