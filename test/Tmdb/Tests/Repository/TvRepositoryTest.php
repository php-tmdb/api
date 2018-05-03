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
namespace Tmdb\Tests\Repository;

class TvRepositoryTest extends TestCase
{
    const TV_ID = 3572;

    /**
     * @test
     */
    public function shouldLoadTv()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/tv/' . self::TV_ID,
                ['append_to_response' => 'credits,external_ids,images,translations,similar,recommendations,keywords,changes,content_ratings,alternative_titles,videos']
            ))
        ;

        $repository->load(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/popular'))
        ;

        $repository->getPopular();
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/credits'))
        ;

        $repository->getCredits(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/external_ids'))
        ;

        $repository->getExternalIds(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/images'))
        ;

        $repository->getImages(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/translations'))
        ;

        $repository->getTranslations(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetOnTheAir()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/on_the_air'))
        ;

        $repository->getOnTheAir();
    }

    /**
     * @test
     */
    public function shouldGetAiringToday()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/airing_today'))
        ;

        $repository->getAiringToday();
    }

    /**
     * @test
     */
    public function shouldGetTopRated()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/top_rated'))
        ;

        $repository->getTopRated();
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/videos'))
        ;

        $repository->getVideos(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetLatestTvShow()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/latest'))
        ;

        $repository->getLatest();
    }

    /**
     * @test
     */
    public function shouldGetContentRatings()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/tv/' . self::TV_ID . '/content_ratings'))
        ;

        $repository->getContentRatings(self::TV_ID);
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
