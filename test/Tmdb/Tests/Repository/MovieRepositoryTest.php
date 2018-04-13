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
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/movie/' . self::MOVIE_ID,
                ['append_to_response' => 'alternative_titles,changes,credits,images,keywords,lists,release_dates,reviews,similar,recommendations,translations,videos']
            ))
        ;

        $repository->load(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetAlternativeTitles()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/alternative_titles'))
        ;

        $repository->getAlternativeTitles(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/credits'))
        ;

        $repository->getCredits(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/images'))
        ;
        $repository->getImages(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetKeywords()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/keywords'))
        ;

        $repository->getKeywords(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetReleases()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/releases'))
        ;

        $repository->getReleases(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/translations'))
        ;

        $repository->getTranslations(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetSimilar()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/similar'))
        ;

        $repository->getSimilar(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetRecommended()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/recommendations'))
        ;

        $repository->getRecommendations(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetReviews()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/reviews'))
        ;

        $repository->getReviews(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetLists()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/lists'))
        ;

        $repository->getLists(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/changes'))
        ;

        $repository->getChanges(self::MOVIE_ID);
    }

    /**
     * @test
     */
    public function shouldGetLatestMovie()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/latest'))
        ;

        $repository->getLatest();
    }

    /**
     * @test
     */
    public function shouldGetUpcoming()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/upcoming'))
        ;

        $repository->getUpcoming();
    }

    /**
     * @test
     */
    public function shouldGetNowPlaying()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/now_playing'))
        ;

        $repository->getNowPlaying();
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/popular'))
        ;

        $repository->getPopular();
    }

    /**
     * @test
     */
    public function shouldGetTopRated()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/top_rated'))
        ;

        $repository->getTopRated();
    }

    /**
     * @test
     */
    public function shouldGetAccountStates()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/id/account_states'))
        ;

        $repository->getAccountStates('id');
    }

    /**
     * @test
     */
    public function shouldRate()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('post')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/movie/id/rating',
                [],
                'POST',
                [],
                ['value' => 5.2]
            ))
        ;

        $repository->rate('id', 5.2);
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/movie/' . self::MOVIE_ID . '/videos'))
        ;

        $repository->getVideos(self::MOVIE_ID);
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

        $repository->setAlternativeTitleFactory($class);
        $repository->setImageFactory($class);
        $repository->setPeopleFactory($class);

        $this->assertInstanceOf('stdClass', $repository->getAlternativeTitleFactory());
        $this->assertInstanceOf('stdClass', $repository->getImageFactory());
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
