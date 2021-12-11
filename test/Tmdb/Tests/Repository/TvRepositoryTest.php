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

class TvRepositoryTest extends TestCase
{
    public const TV_ID = 3572;

    /**
     * @test
     */
    public function shouldLoadTv()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->load(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID);
        $this->assertRequestHasQueryParameters(
            ['append_to_response' => 'credits,external_ids,images,translations,similar,recommendations,keywords,changes,content_ratings,alternative_titles,videos,watch/providers,episode_groups']
        );
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getPopular();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/popular');
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getCredits(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/credits');
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getExternalIds(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/external_ids');
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getImages(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/images');
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getTranslations(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/translations');
    }

    /**
     * @test
     */
    public function shouldGetSimilar()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getSimilar(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/similar');
    }

    /**
     * @test
     */
    public function shouldGetRecommended()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getRecommendations(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/recommendations');
    }

    /**
     * @test
     */
    public function shouldGetAlternativeTitles()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getAlternativeTitles(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/alternative_titles');
    }

    /**
     * @test
     */
    public function shouldGetAccountStates()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getAccountStates(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/account_states');
    }

    /**
     * @test
     */
    public function shouldGetOnTheAir()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getOnTheAir();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/on_the_air');
    }

    /**
     * @test
     */
    public function shouldGetAiringToday()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getAiringToday();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/airing_today');
    }

    /**
     * @test
     */
    public function shouldGetTopRated()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getTopRated();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/top_rated');
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getVideos(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/videos');
    }

    /**
     * @test
     */
    public function shouldGetWatchProviders()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getWatchProviders(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/watch/providers');
    }

    /**
     * @test
     */
    public function shouldGetLatestTvShow()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getLatest();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/latest');
    }

    /**
     * @test
     */
    public function shouldGetContentRatings()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getContentRatings(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/content_ratings');
    }

    /**
     * @test
     */
    public function shouldRate()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->rate(self::TV_ID, 6.2);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/rating', 'POST');
        $this->assertRequestBodyHasContents([
            'value' => 6.2
        ]);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Tv';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\TvRepository';
    }
}
