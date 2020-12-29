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

class TvEpisodeTest extends TestCase
{
    public const TV_ID = 3572;
    public const SEASON_ID = 1;
    public const EPISODE_ID = 1;

    /**
     * @test
     */
    public function shouldGetEpisode()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getEpisode(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID
        );
    }

    /**
     * @test
     */
    public function shouldGetEpisodeCredits()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCredits(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/credits'
        );
    }

    /**
     * @test
     */
    public function shouldGetEpisodeExternalIds()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getExternalIds(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/external_ids'
        );
    }

    /**
     * @test
     */
    public function shouldGetEpisodeImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getImages(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/images'
        );
    }

    /**
     * @test
     */
    public function shouldGetEpisodeVideos()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getVideos(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/videos'
        );
    }

    /**
     * @test
     */
    public function shouldGetEpisodeChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getChanges(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/changes'
        );
    }

    /**
     * @test
     */
    public function shouldGetEpisodeAccountStates()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getAccountStates(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/account_states'
        );
    }

    /**
     * @test
     */
    public function shouldGetEpisodeTranslations()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTranslations(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/translations'
        );
    }

    /**
     * @test
     */
    public function shouldRateTvEpisode()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->rateTvEpisode(self::TV_ID, self::SEASON_ID, self::EPISODE_ID, 8.5);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/rating',
            'POST'
        );
        $this->assertRequestBodyHasContents(
            [
                'value' => 8.5
            ]
        );
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\TvEpisode';
    }
}
