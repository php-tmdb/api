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
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->load(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getPopular();
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getCredits(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getExternalIds(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getImages(self::TV_ID);
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getTranslations(self::TV_ID);
    }

    /**
     * @test
     * @todo fix later
     */
    public function shouldGetOnTheAir()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        //$repository->getOnTheAir();
    }

    /**
     * @test
     */
    public function shouldGetTopRated()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getTopRated();
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
