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

use Tmdb\Repository\MovieRepository;

class MovieRepositoryTest extends TestCase
{
    const MOVIE_ID = 120;

    /**
     * @test
     */
    public function shouldLoadMovie()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->load(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetAlternativeTitles()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getAlternativeTitles(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getCredits(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getImages(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetKeywords()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getKeywords(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetReleases()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getReleases(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetTrailers()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getTrailers(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getTranslations(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetSimilarMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getSimilarMovies(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetReviews()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getReviews(self::MOVIE_ID);
    }

    /**
     * @test
     * @todo FIX
     */
    public function shouldGetLists()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getLists(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getChanges(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetLatestMovie()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getLatest();
    }

    /**
     * @test
     */
    public function shouldGetUpcoming()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getUpcoming();
    }

    /**
     * @test
     */
    public function shouldGetNowPlaying()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getNowPlaying();
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
    public function shouldGetTopRated()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getTopRated();
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var MovieRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();
        $class      = new \stdClass();

        $repository->setAlternativeTitlesFactory($class);
        $repository->setImagesFactory($class);
        $repository->setPeopleFactory($class);

        $this->assertInstanceOf('stdClass', $repository->getAlternativeTitlesFactory());
        $this->assertInstanceOf('stdClass', $repository->getImagesFactory());
        $this->assertInstanceOf('stdClass', $repository->getPeopleFactory());
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Movies';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\MovieRepository';
    }
}