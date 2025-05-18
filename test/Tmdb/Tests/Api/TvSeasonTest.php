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

class TvSeasonTest extends TestCase
{
    public const TV_ID = 3572;
    public const SEASON_ID = 1;

    /**
     * */
    #[Test]
    public function shouldGetSeason()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getSeason(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID);
    }

    /**
     * */
    #[Test]
    public function shouldGetSeasonCredits()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCredits(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/credits');
    }

    /**
     * */
    #[Test]
    public function shouldGetSeasonExternalIds()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getExternalIds(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/external_ids'
        );
    }

    /**
     * */
    #[Test]
    public function shouldGetSeasonImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getImages(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/images');
    }

    /**
     * */
    #[Test]
    public function shouldGetSeasonVideos()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getVideos(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/videos');
    }

    /**
     * */
    #[Test]
    public function shouldGetSeasonChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getChanges(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/changes');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\TvSeason';
    }
}
