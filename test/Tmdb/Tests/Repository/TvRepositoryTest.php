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

use PHPUnit\Framework\Attributes\Test;

class TvRepositoryTest extends TestCase
{
    public const TV_ID = 3572;

    /**
     * */
    #[Test]
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
     * */
    #[Test]
    public function shouldGetPopular()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getPopular();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/popular');
    }

    /**
     * */
    #[Test]
    public function shouldGetCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getCredits(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/credits');
    }

    /**
     * */
    #[Test]
    public function shouldGetExternalIds()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getExternalIds(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/external_ids');
    }

    /**
     * */
    #[Test]
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getImages(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/images');
    }

    /**
     * */
    #[Test]
    public function shouldGetTranslations()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getTranslations(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/translations');
    }

    /**
     * */
    #[Test]
    public function shouldGetSimilar()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getSimilar(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/similar');
    }

    /**
     * */
    #[Test]
    public function shouldGetRecommended()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getRecommendations(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/recommendations');
    }

    /**
     * */
    #[Test]
    public function shouldGetAlternativeTitles()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getAlternativeTitles(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/alternative_titles');
    }

    /**
     * */
    #[Test]
    public function shouldGetAccountStates()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getAccountStates(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/account_states');
    }

    /**
     * */
    #[Test]
    public function shouldGetOnTheAir()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getOnTheAir();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/on_the_air');
    }

    /**
     * */
    #[Test]
    public function shouldGetAiringToday()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getAiringToday();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/airing_today');
    }

    /**
     * */
    #[Test]
    public function shouldGetTopRated()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getTopRated();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/top_rated');
    }

    /**
     * */
    #[Test]
    public function shouldGetVideos()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getVideos(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/videos');
    }

    /**
     * */
    #[Test]
    public function shouldGetWatchProviders()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getWatchProviders(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/watch/providers');
    }

    /**
     * */
    #[Test]
    public function shouldGetLatestTvShow()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getLatest();
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/latest');
    }

    /**
     * */
    #[Test]
    public function shouldGetContentRatings()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getContentRatings(self::TV_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/content_ratings');
    }

    /**
     * */
    #[Test]
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
