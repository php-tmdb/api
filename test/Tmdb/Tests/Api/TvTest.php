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

class TvTest extends TestCase
{
    public const TV_ID = 3572;

    /**
     * @test
     */
    public function shouldGetTvshow()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTvshow(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCredits(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/credits');
    }

    /**
     * @test
     */
    public function getExternalIds()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getExternalIds(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/external_ids');
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getImages(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/images');
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTranslations(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/translations');
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getPopular();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/popular');
    }

    /**
     * @test
     */
    public function shouldGetTopRated()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTopRated();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/top_rated');
    }

    /**
     * @test
     */
    public function shouldGetOnTheAir()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getOnTheAir();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/on_the_air');
    }

    /**
     * @test
     */
    public function shouldGetAiringToday()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getAiringToday();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/airing_today');
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getVideos(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/videos');
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getChanges(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/changes');
    }

    /**
     * @test
     */
    public function shouldGetKeywords()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getKeywords(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/keywords');
    }

    /**
     * @test
     */
    public function shouldGetSimilar()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getSimilar(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/similar');
    }

    /**
     * @test
     */
    public function shouldGetRecommended()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getRecommendations(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/recommendations');
    }

    /**
     * @test
     */
    public function shouldRateTvEpisode()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->rateTvShow(self::TV_ID, 8.5);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/rating', 'POST');
        $this->assertRequestBodyHasContents(
            [
                'value' => 8.5
            ]
        );
    }

    /**
     * @test
     */
    public function shouldGetLatest()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getLatest();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/latest');
    }

    /**
     * @test
     */
    public function shouldGetAccountStates()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getAccountStates(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/account_states');
    }

    /**
     * @test
     */
    public function shouldGetContentRatings()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getContentRatings(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/content_ratings');
    }

    /**
     * @test
     */
    public function shouldGetWatchProviders()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getWatchProviders(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/watch/providers');
    }

    /**
     * @test
     */
    public function shouldGetEpisodeGroups()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getEpisodeGroups(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/episode_groups');
    }


    protected function getApiClass()
    {
        return 'Tmdb\Api\Tv';
    }
}
