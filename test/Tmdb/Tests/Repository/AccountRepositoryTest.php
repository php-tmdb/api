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

use Tmdb\Api\Account;
use Tmdb\Model\Movie;
use Tmdb\Model\Tv;
use Tmdb\Repository\AccountRepository;

class AccountRepositoryTest extends TestCase
{
    public const ACCOUNT_ID = '12345';
    public const LIST_ID  = '509ec17b19c2950a0600050d';
    public const MEDIA_ID = 150;

    /**
     * @test
     */
    public function shouldGetAccount()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getAccount();
        $this->assertLastRequestIsWithPathAndMethod('/3/account');
    }

    /**
     * @test
     */
    public function shouldGetLists()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getLists(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/lists');
    }

    /**
     * @test
     */
    public function shouldGetFavoriteMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getFavoriteMovies(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/favorite/movies');
    }

    /**
     * @test
     */
    public function shouldGetFavoriteTvShows()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getFavoriteTvShows(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/favorite/tv');
    }

    /**
     * @test
     */
    public function shouldGetWatchlistMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getMovieWatchlist(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/watchlist/movies');
    }

    /**
     * @test
     */
    public function shouldGetWatchlistTvShows()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getTvWatchlist(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/watchlist/tv');
    }

    /**
     * @test
     */
    public function shouldGetRatedTvShows()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getRatedTvShows(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/rated/tv');
    }

    /**
     * @test
     */
    public function shouldFavorite()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->favorite(self::ACCOUNT_ID, self::MEDIA_ID, true);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/favorite', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'media_id' => self::MEDIA_ID,
                'media_type' => 'movie',
                'favorite' => true
            ]
        );
    }

    /**
     * @test
     */
    public function shouldFavoriteMovieObject()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $movie = new Movie();
        $movie->setId(self::MEDIA_ID);

        $repository->favorite(self::ACCOUNT_ID, $movie, true);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/favorite', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'media_id' => self::MEDIA_ID,
                'media_type' => 'movie',
                'favorite' => true
            ]
        );
    }

    /**
     * @test
     */
    public function shouldFavoriteTvObject()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::MEDIA_ID);

        $repository->favorite(self::ACCOUNT_ID, $tv, true);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/favorite', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'media_id' => self::MEDIA_ID,
                'media_type' => 'tv',
                'favorite' => true
            ]
        );
    }

    /**
     * @test
     */
    public function shouldGetRatedMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getRatedMovies(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/rated/movies');
    }

    /**
     * @test
     */
    public function shouldWatchlist()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->watchlist(self::ACCOUNT_ID, self::MEDIA_ID, true);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/watchlist', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'media_id' => self::MEDIA_ID,
                'media_type' => 'movie',
                'watchlist' => true
            ]
        );
    }

    /**
     * @test
     */
    public function shouldWatchlistMovieObject()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $movie = new Movie();
        $movie->setId(self::MEDIA_ID);

        $repository->watchlist(self::ACCOUNT_ID, $movie, true);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/watchlist', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'media_id' => self::MEDIA_ID,
                'media_type' => 'movie',
                'watchlist' => true
            ]
        );
    }

    /**
     * @test
     */
    public function shouldWatchlistTvObject()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::MEDIA_ID);

        $repository->watchlist(self::ACCOUNT_ID, $tv, true);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/watchlist', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'media_id' => self::MEDIA_ID,
                'media_type' => 'tv',
                'watchlist' => true
            ]
        );
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
