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

class MoviesTest extends TestCase
{
    public const MOVIE_ID = 120;

    /**
     * @test
     */
    public function shouldGetMovie()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getMovie(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetAlternativeTitles()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getAlternativeTitles(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/alternative_titles');
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getExternalIds(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/external_ids');
    }

    /**
     * @test
     */
    public function shouldGetCast()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCredits(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/credits');
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getImages(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/images');
    }

    /**
     * @test
     */
    public function shouldGetKeywords()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getKeywords(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/keywords');
    }

    /**
     * @test
     */
    public function getReleases()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getReleases(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/releases');
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTranslations(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/translations');
    }

    /**
     * @test
     */
    public function shouldGetSimilarMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getSimilar(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/similar');
    }

    /**
     * @test
     */
    public function shouldGetRecommendedMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getRecommendations(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/recommendations');
    }

    /**
     * @test
     */
    public function shouldGetReviews()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getReviews(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/reviews');
    }

    /**
     * @test
     */
    public function shouldGetLists()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getLists(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/lists');
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getChanges(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/changes');
    }

    /**
     * @test
     */
    public function shouldGetLatest()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getLatest();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/latest');
    }

    /**
     * @test
     */
    public function shouldGetUpcoming()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getUpcoming();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/upcoming');
    }

    /**
     * @test
     */
    public function shouldGetNowPlaying()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getNowPlaying();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/now_playing');
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getPopular();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/popular');
    }

    /**
     * @test
     */
    public function shouldGetTopRated()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTopRated();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/top_rated');
    }

    /**
     * @test
     */
    public function shouldGetAccountStates()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getAccountStates(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/account_states');
    }

    /**
     * @test
     */
    public function shouldRateMovie()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->rateMovie(self::MOVIE_ID, 7.5);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/rating', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'value' => 7.5
            ]
        );
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getVideos(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/videos');
    }

    /**
     * @test
     */
    public function shouldGetWatchProviders()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getWatchProviders(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/watch/providers');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Movies';
    }
}
