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

class AccountTest extends TestCase
{
    const ACCOUNT_ID = 1;
    const MEDIA_ID   = 123;

    /**
     * @test
     */
    public function shouldGetAccount()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account'))
        ;

        $api->getAccount();
    }

    /**
     * @test
     */
    public function shouldGetLists()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/lists'))
        ;

        $api->getLists(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetFavoriteMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/favorite/movies'))
        ;

        $api->getFavoriteMovies(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetFavoriteTv()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/favorite/tv'))
        ;

        $api->getFavoriteTvShows(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldFavorite()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('post')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/favorite', [], 'POST', [], [
                'media_id'   => self::MEDIA_ID,
                'media_type' => 'movie',
                'favorite'   => true
            ]))
        ;

        $api->favorite(self::ACCOUNT_ID, self::MEDIA_ID, true, 'movie');
    }

    /**
     * @test
     */
    public function shouldGetRatedMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/rated/movies'))
        ;

        $api->getRatedMovies(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetRatedTvShows()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/rated/tv'))
        ;

        $api->getRatedTvShows(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetMovieWatchlist()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/watchlist/movies'))
        ;

        $api->getMovieWatchlist(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldGetTvShowWatchlist()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/watchlist/tv'))
        ;

        $api->getTvWatchlist(self::ACCOUNT_ID);
    }

    /**
     * @test
     */
    public function shouldWatchlist()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('post')
            ->with($this->getRequest('account/'.self::ACCOUNT_ID.'/watchlist', [], 'POST', [], [
                'media_id'   => self::MEDIA_ID,
                'media_type' => 'movie',
                'watchlist'  => true
            ]))
        ;

        $api->watchlist(self::ACCOUNT_ID, self::MEDIA_ID, true, 'movie');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Account';
    }
}
