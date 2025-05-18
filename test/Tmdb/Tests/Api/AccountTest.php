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

use PHPUnit\Framework\Attributes\Test;

class AccountTest extends TestCase
{
    public const ACCOUNT_ID = 1;
    public const MEDIA_ID = 123;

    /**
     * */
    #[Test]
    public function shouldGetAccount()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getAccount();
        $this->assertLastRequestIsWithPathAndMethod('/3/account');
    }

    /**
     * */
    #[Test]
    public function shouldGetLists()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getLists(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/lists');
    }

    /**
     * */
    #[Test]
    public function shouldGetFavoriteMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getFavoriteMovies(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/favorite/movies');
    }

    /**
     * */
    #[Test]
    public function shouldGetFavoriteTv()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getFavoriteTvShows(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/favorite/tv');
    }

    /**
     * */
    #[Test]
    public function shouldFavorite()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->favorite(self::ACCOUNT_ID, self::MEDIA_ID, true, 'movie');
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
     * */
    #[Test]
    public function shouldGetRatedMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getRatedMovies(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/rated/movies');
    }

    /**
     * */
    #[Test]
    public function shouldGetRatedTvShows()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getRatedTvShows(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/rated/tv');
    }

    /**
     * */
    #[Test]
    public function shouldGetMovieWatchlist()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getMovieWatchlist(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/watchlist/movies');
    }

    /**
     * */
    #[Test]
    public function shouldGetTvShowWatchlist()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTvWatchlist(self::ACCOUNT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/watchlist/tv');
    }

    /**
     * */
    #[Test]
    public function shouldWatchlist()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->watchlist(self::ACCOUNT_ID, self::MEDIA_ID, true, 'movie');
        $this->assertLastRequestIsWithPathAndMethod('/3/account/' . self::ACCOUNT_ID . '/watchlist', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'media_id' => self::MEDIA_ID,
                'media_type' => 'movie',
                'watchlist' => true
            ]
        );
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Account';
    }
}
