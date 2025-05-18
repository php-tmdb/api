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

class TvEpisodeTest extends TestCase
{
    public const TV_ID = 3572;
    public const SEASON_ID = 1;
    public const EPISODE_ID = 1;

    /**
     * */
    #[Test]
    public function shouldGetEpisode()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getEpisode(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID
        );
    }

    /**
     * */
    #[Test]
    public function shouldGetEpisodeCredits()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCredits(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/credits'
        );
    }

    /**
     * */
    #[Test]
    public function shouldGetEpisodeExternalIds()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getExternalIds(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/external_ids'
        );
    }

    /**
     * */
    #[Test]
    public function shouldGetEpisodeImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getImages(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/images'
        );
    }

    /**
     * */
    #[Test]
    public function shouldGetEpisodeVideos()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getVideos(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/videos'
        );
    }

    /**
     * */
    #[Test]
    public function shouldGetEpisodeChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getChanges(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/changes'
        );
    }

    /**
     * */
    #[Test]
    public function shouldGetEpisodeAccountStates()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getAccountStates(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/account_states'
        );
    }

    /**
     * */
    #[Test]
    public function shouldGetEpisodeTranslations()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTranslations(self::TV_ID, self::SEASON_ID, self::EPISODE_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/episode/' . self::EPISODE_ID . '/translations'
        );
    }

    /**
     * */
    #[Test]
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
