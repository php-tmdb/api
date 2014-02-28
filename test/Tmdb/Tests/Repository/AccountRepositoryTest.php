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

use Tmdb\Api\Account;
use Tmdb\Model\Movie;
use Tmdb\Repository\AccountRepository;

class AccountRepositoryTest extends TestCase
{
    const ACCOUNT_ID = '12345';
    const LIST_ID  = '509ec17b19c2950a0600050d';
    const MOVIE_ID = 150;

    /**
     * @test
     */
    public function shouldGetAccount()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getAccount();
    }

    /**
     * @test
     */
    public function shouldGetLists()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getLists(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetFavoriteMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getFavoriteMovies(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldFavorite()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->favorite(self::ACCOUNT_ID, self::MOVIE_ID, true);
    }

    /**
     * @test
     */
    public function shouldFavoriteMovieObject()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $movie = new Movie();
        $movie->setId(self::MOVIE_ID);

        $repository->favorite(self::ACCOUNT_ID, $movie, true);
    }

    /**
     * @test
     */
    public function shouldGetRatedMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getRatedMovies(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldWatchlist()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->watchlist(self::ACCOUNT_ID, self::MOVIE_ID, true);
    }

    /**
     * @test
     */
    public function shouldWatchlistMovieObject()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $movie = new Movie();
        $movie->setId(self::MOVIE_ID);

        $repository->watchlist(self::ACCOUNT_ID, $movie, true);
    }

    /**
     * @return Account
     */
    protected function getApiClass()
    {
        return 'Tmdb\Api\Account';
    }

    /**
     * @return AccountRepository
     */
    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\AccountRepository';
    }
}
