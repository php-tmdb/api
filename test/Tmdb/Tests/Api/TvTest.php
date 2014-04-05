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

class TvTest extends TestCase
{
    const TV_ID = 3572;

    /**
     * @test
     */
    public function shouldGetTvshow()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/' . self::TV_ID);

        $api->getTvshow(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/' . self::TV_ID . '/credits');

        $api->getCredits(self::TV_ID);
    }

    /**
     * @test
     */
    public function getExternalIds()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/' . self::TV_ID . '/external_ids');

        $api->getExternalIds(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/' . self::TV_ID . '/images');

        $api->getImages(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/' . self::TV_ID . '/translations');

        $api->getTranslations(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/popular');

        $api->getPopular();
    }

    /**
     * @test
     */
    public function shouldGetTopRated()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/top_rated');

        $api->getTopRated();
    }

    /**
     * @test
     */
    public function shouldGetOnTheAir()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/on_the_air');

        $api->getOnTheAir();
    }

    /**
     * @test
     */
    public function shouldGetAiringToday()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/airing_today');

        $api->getAiringToday();
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('tv/' . self::TV_ID . '/videos');

        $api->getVideos(self::TV_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Tv';
    }
}
