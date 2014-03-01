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

class TvSeasonTest extends TestCase
{
    const TV_ID     = 3572;
    const SEASON_ID = 1;

    /**
     * @test
     */
    public function shouldGetSeason()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/' . self::TV_ID . '/season/' . self::SEASON_ID);

        $api->getSeason(self::TV_ID, self::SEASON_ID);
    }

    /**
     * @test
     */
    public function shouldGetSeasonCredits()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/credits');

        $api->getCredits(self::TV_ID, self::SEASON_ID);
    }

    /**
     * @test
     */
    public function shouldGetSeasonExternalIds()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/external_ids');

        $api->getExternalIds(self::TV_ID, self::SEASON_ID);
    }

    /**
     * @test
     */
    public function shouldGetSeasonImages()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/images');

        $api->getImages(self::TV_ID, self::SEASON_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\TvSeason';
    }
}
