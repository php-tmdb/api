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
use Tmdb\Model\Tv;
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
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account'))
        ;

        $repository->getAccount();
    }

    /**
     * @test
     */
    public function shouldGetLists()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/lists'))
        ;

        $repository->getLists(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetFavoriteMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/favorite/movies'))
        ;

        $repository->getFavoriteMovies(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetFavoriteTvShows()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/favorite/tv'))
        ;

        $repository->getFavoriteTvShows(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetWatchlistMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/watchlist/movies'))
        ;

        $repository->getMovieWatchlist(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetWatchlistTvShows()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/watchlist/tv'))
        ;

        $repository->getTvWatchlist(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetRatedTvShows()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/rated/tv'))
        ;

        $repository->getRatedTvShows(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldFavorite()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest(
                'account/'.self::ACCOUNT_ID.'/favorite',
                [],
                'POST',
                [],
                ['media_id' => self::MOVIE_ID, 'media_type' => 'movie', 'favorite' => true]
            ))
        ;

        $repository->favorite(self::ACCOUNT_ID, self::MOVIE_ID, true);
    }

    /**
     * @test
     */
    public function shouldFavoriteMovieObject()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest(
                'account/'.self::ACCOUNT_ID.'/favorite',
                [],
                'POST',
                [],
                ['media_id' => self::MOVIE_ID, 'media_type' => 'movie', 'favorite' => true]
            ))
        ;

        $movie = new Movie();
        $movie->setId(self::MOVIE_ID);

        $repository->favorite(self::ACCOUNT_ID, $movie, true);
    }

    /**
     * @test
     */
    public function shouldFavoriteTvObject()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest(
                'account/'.self::ACCOUNT_ID.'/favorite',
                [],
                'POST',
                [],
                ['media_id' => self::MOVIE_ID, 'media_type' => 'tv', 'favorite' => true]
            ))
        ;

        $tv = new Tv();
        $tv->setId(self::MOVIE_ID);

        $repository->favorite(self::ACCOUNT_ID, $tv, true);
    }

    /**
     * @test
     */
    public function shouldGetRatedMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/rated/movies'))
        ;

        $repository->getRatedMovies(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldWatchlist()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest(
                'account/'.self::ACCOUNT_ID.'/watchlist',
                [],
                'POST',
                [],
                ['media_id' => self::MOVIE_ID, 'media_type' => 'movie', 'watchlist' => true]
            ))
        ;

        $repository->watchlist(self::ACCOUNT_ID, self::MOVIE_ID, true);
    }

    /**
     * @test
     */
    public function shouldWatchlistMovieObject()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest(
                'account/'.self::ACCOUNT_ID.'/watchlist',
                [],
                'POST',
                [],
                ['media_id' => self::MOVIE_ID, 'media_type' => 'movie', 'watchlist' => true]
            ))
        ;

        $movie = new Movie();
        $movie->setId(self::MOVIE_ID);

        $repository->watchlist(self::ACCOUNT_ID, $movie, true);
    }

    /**
     * @test
     */
    public function shouldWatchlistTvObject()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest(
                'account/'.self::ACCOUNT_ID.'/watchlist',
                [],
                'POST',
                [],
                ['media_id' => self::MOVIE_ID, 'media_type' => 'tv', 'watchlist' => true]
            ))
        ;

        $tv = new Tv();
        $tv->setId(self::MOVIE_ID);

        $repository->watchlist(self::ACCOUNT_ID, $tv, true);
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
