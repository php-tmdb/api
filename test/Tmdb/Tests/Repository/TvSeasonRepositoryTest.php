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

use Tmdb\Model\Tv;

class TvSeasonRepositoryTest extends TestCase
{
    const TV_ID     = 3572;
    const SEASON_ID = 1;

    /**
     * @test
     */
    public function shouldLoadTvSeason()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID,
                ['append_to_response' => 'credits,external_ids,images,changes,videos']
            ))
        ;

        $repository->load(self::TV_ID, self::SEASON_ID);
    }

    /**
     * @test
     */
    public function shouldBeAbleToLoadTvSeasonWithTvAndSeason()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID,
                ['append_to_response' => 'credits,external_ids,images,changes,videos']
            ))
        ;

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setId(self::SEASON_ID);

        $repository->load($tv, $season);
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/credits'
            ))
        ;

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setId(self::SEASON_ID);

        $repository->getCredits($tv, $season);
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/external_ids'
            ))
        ;

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setId(self::SEASON_ID);

        $repository->getExternalIds($tv, $season);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/images'
            ))
        ;

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setId(self::SEASON_ID);

        $repository->getImages($tv, $season);
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/videos'
            ))
        ;

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setId(self::SEASON_ID);

        $repository->getVideos($tv, $season);
    }

    /**
     * @expectedException Tmdb\Exception\RuntimeException
     * @test
     */
    public function shouldThrowExceptionWhenConditionsNotMet()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $repository->load($tv, null);
    }

    /**
     * @expectedException Tmdb\Exception\RuntimeException
     * @test
     */
    public function shouldThrowExceptionWhenConditionsNotMetAll()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();
        $repository->load(null, null);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\TvSeason';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\TvSeasonRepository';
    }
}
