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

use Tmdb\Repository\MovieRepository;

class MovieRepositoryTest extends TestCase
{
    public const MOVIE_ID = 120;

    /**
     * @test
     */
    public function shouldLoadMovie()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->load(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID);
        $this->assertRequestHasQueryParameters([
            'append_to_response' => 'alternative_titles,external_ids,changes,credits,images,keywords,lists,release_dates,reviews,similar,recommendations,translations,videos,watch/providers'
        ]);
    }

    /**
     * @test
     */
    public function shouldGetAlternativeTitles()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getAlternativeTitles(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/alternative_titles');
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getExternalIds(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/external_ids');
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getCredits(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/credits');
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getImages(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/images');
    }

    /**
     * @test
     */
    public function shouldGetKeywords()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getKeywords(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/keywords');
    }

    /**
     * @test
     */
    public function shouldGetReleases()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getReleases(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/releases');
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getTranslations(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/translations');
    }

    /**
     * @test
     */
    public function shouldGetSimilar()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getSimilar(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/similar');
    }

    /**
     * @test
     */
    public function shouldGetRecommended()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getRecommendations(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/recommendations');
    }

    /**
     * @test
     */
    public function shouldGetReviews()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getReviews(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/reviews');
    }

    /**
     * @test
     */
    public function shouldGetLists()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getLists(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/lists');
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getChanges(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/changes');
    }

    /**
     * @test
     */
    public function shouldGetLatestMovie()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getLatest();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/latest');
    }

    /**
     * @test
     */
    public function shouldGetUpcoming()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getUpcoming();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/upcoming');
    }

    /**
     * @test
     */
    public function shouldGetNowPlaying()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getNowPlaying();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/now_playing');
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getPopular();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/popular');
    }

    /**
     * @test
     */
    public function shouldGetTopRated()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getTopRated();
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/top_rated');
    }

    /**
     * @test
     */
    public function shouldGetAccountStates()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getAccountStates(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/account_states');
    }

    /**
     * @test
     */
    public function shouldRate()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->rate(self::MOVIE_ID, 5.2);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/rating', 'POST');
        $this->assertRequestBodyHasContents([
            'value' => 5.2
        ]);
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getVideos(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/videos');
    }

    /**
     * @test
     */
    public function shouldGetWatchProviders()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getWatchProviders(self::MOVIE_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/' . self::MOVIE_ID . '/watch/providers');
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var MovieRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();
        $class      = new \stdClass();

        $repository->setAlternativeTitleFactory($class);
        $repository->setImageFactory($class);
        $repository->setPeopleFactory($class);

        $this->assertInstanceOf('stdClass', $repository->getAlternativeTitleFactory());
        $this->assertInstanceOf('stdClass', $repository->getImageFactory());
        $this->assertInstanceOf('stdClass', $repository->getPeopleFactory());
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Movies';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\MovieRepository';
    }
}
