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

use Tmdb\Exception\RuntimeException;
use Tmdb\Model\Tv;
use Tmdb\Model\Tv\Episode;
use Tmdb\Model\Tv\Season;

class TvEpisodeRepositoryTest extends TestCase
{
    public const TV_ID = 3572;
    public const SEASON_NUMBER = 1;
    public const EPISODE_NUMBER = 1;

    /**
     * @test
     */
    public function shouldLoadTvEpisode()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->load(self::TV_ID, self::SEASON_NUMBER, self::EPISODE_NUMBER);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/episode/' . self::EPISODE_NUMBER
        );
        $this->assertRequestHasQueryParameters(
            ['append_to_response' => 'credits,external_ids,images,translations,changes,videos']
        );
    }

    /**
     * @test
     */
    public function shouldBeAbleToLoadTvSeasonWithTvAndSeason()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $episode = new Episode();
        $episode->setEpisodeNumber(self::EPISODE_NUMBER);

        $repository->load($tv, $season, $episode);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/episode/' . self::EPISODE_NUMBER
        );
        $this->assertRequestHasQueryParameters(
            ['append_to_response' => 'credits,external_ids,images,translations,changes,videos']
        );
    }

    /**
     * @test
     */
    public function shouldGetAccountStates()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $episode = new Episode();
        $episode->setEpisodeNumber(self::EPISODE_NUMBER);

        $repository->getAccountStates($tv, $season, $episode);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/episode/' . self::EPISODE_NUMBER . '/account_states'
        );
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $episode = new Episode();
        $episode->setEpisodeNumber(self::EPISODE_NUMBER);

        $repository->getCredits($tv, $season, $episode);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/episode/' . self::EPISODE_NUMBER . '/credits'
        );
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $episode = new Episode();
        $episode->setEpisodeNumber(self::EPISODE_NUMBER);

        $repository->getExternalIds($tv, $season, $episode);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/episode/' . self::EPISODE_NUMBER . '/external_ids'
        );
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $episode = new Episode();
        $episode->setEpisodeNumber(self::EPISODE_NUMBER);

        $repository->getImages($tv, $season, $episode);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/episode/' . self::EPISODE_NUMBER . '/images'
        );
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $episode = new Episode();
        $episode->setEpisodeNumber(self::EPISODE_NUMBER);

        $repository->getTranslations($tv, $season, $episode);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/episode/' . self::EPISODE_NUMBER . '/translations'
        );
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $episode = new Episode();
        $episode->setEpisodeNumber(self::EPISODE_NUMBER);

        $repository->getVideos($tv, $season, $episode);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/episode/' . self::EPISODE_NUMBER . '/videos'
        );
    }

    /**
     * @test
     */
    public function shouldRate()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->rate(self::TV_ID, self::SEASON_NUMBER, self::EPISODE_NUMBER, 6.2);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/episode/' . self::EPISODE_NUMBER . '/rating',
            'POST'
        );
        $this->assertRequestBodyHasContents([
            'value' => 6.2
        ]);
    }

    /**
     * @test
     */
    public function shouldRateModel()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $episode = new Episode();
        $episode->setEpisodeNumber(self::EPISODE_NUMBER);

        $repository->rate($tv, $season, $episode, 7.2);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/episode/' . self::EPISODE_NUMBER . '/rating',
            'POST'
        );
        $this->assertRequestBodyHasContents([
            'value' => 7.2
        ]);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenConditionsNotMet()
    {
        $this->expectException(RuntimeException::class);
        $repository = $this->getRepositoryWithMockedHttpClient();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $repository->load($tv, $season, null);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenConditionsNotMetAll()
    {
        $this->expectException(RuntimeException::class);
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->load(null, null, null);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\TvEpisode';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\TvEpisodeRepository';
    }
}
