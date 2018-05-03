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

class MoviesTest extends TestCase
{
    const MOVIE_ID = 120;

    /**
     * @test
     */
    public function shouldGetMovie()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID));

        $api->getMovie(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetAlternativeTitles()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/alternative_titles'));

        $api->getAlternativeTitles(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetCast()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/credits'));

        $api->getCredits(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/images'));

        $api->getImages(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetKeywords()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/keywords'));

        $api->getKeywords(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function getReleases()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/releases'));

        $api->getReleases(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetTrailers()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/trailers'));

        $api->getTrailers(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/translations'));

        $api->getTranslations(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetSimilarMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/similar'));

        $api->getSimilar(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetRecommendedMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/recommendations'));

        $api->getRecommendations(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetReviews()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/reviews'));

        $api->getReviews(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetLists()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/lists'));

        $api->getLists(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/changes'));

        $api->getChanges(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetLatest()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/latest'));

        $api->getLatest();
    }

    /**
     * @test
     */
    public function shouldGetUpcoming()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/upcoming'));

        $api->getUpcoming();
    }

    /**
     * @test
     */
    public function shouldGetNowPlaying()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/now_playing'));

        $api->getNowPlaying();
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/popular'));

        $api->getPopular();
    }

    /**
     * @test
     */
    public function shouldGetTopRated()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/top_rated'))
        ;

        $api->getTopRated();
    }

    /**
     * @test
     */
    public function shouldGetAccountStates()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/'.self::MOVIE_ID.'/account_states'))
        ;

        $api->getAccountStates(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldRateMovie()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('post')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/'.self::MOVIE_ID.'/rating', [], 'POST', [], ['value' => 7.5]))
        ;

        $api->rateMovie(self::MOVIE_ID, 7.5);
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/videos'));

        $api->getVideos(self::MOVIE_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Movies';
    }
}
