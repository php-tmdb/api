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
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID));

        $api->getTvshow(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/credits'));

        $api->getCredits(self::TV_ID);
    }

    /**
     * @test
     */
    public function getExternalIds()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/external_ids'));

        $api->getExternalIds(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/images'));

        $api->getImages(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/translations'));

        $api->getTranslations(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/popular'));

        $api->getPopular();
    }

    /**
     * @test
     */
    public function shouldGetTopRated()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/top_rated'));

        $api->getTopRated();
    }

    /**
     * @test
     */
    public function shouldGetOnTheAir()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/on_the_air'));

        $api->getOnTheAir();
    }

    /**
     * @test
     */
    public function shouldGetAiringToday()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/airing_today'));

        $api->getAiringToday();
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/videos'))
        ;

        $api->getVideos(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/changes'))
        ;

        $api->getChanges(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetKeywords()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/keywords'))
        ;

        $api->getKeywords(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetSimilar()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/similar'))
        ;

        $api->getSimilar(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetRecommended()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/recommendations'))
        ;

        $api->getRecommendations(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldRateTvEpisode()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/tv/' . self::TV_ID . '/rating',
                [],
                'POST',
                [],
                ['value' => 8.5]
            ))
        ;

        $api->rateTvShow(self::TV_ID, 8.5);
    }

    /**
     * @test
     */
    public function shouldGetLatest()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/latest'));

        $api->getLatest();
    }

    /**
     * @test
     */
    public function shouldGetAccountStates()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/account_states'));

        $api->getAccountStates(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetContentRatings()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/content_ratings'));

        $api->getContentRatings(self::TV_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Tv';
    }
}
