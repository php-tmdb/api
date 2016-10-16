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

class GenreRepositoryTest extends TestCase
{
    const GENRE_ID = 28;

    /**
     * @test
     */
    public function shouldLoadGenre()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->at(0))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/movie/list', []))
        ;

        $this->getAdapter()->expects($this->at(1))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/tv/list', []))
        ;

        $repository->load(self::GENRE_ID);
    }

    /**
     * @test
     */
    public function shouldLoadCollection()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->at(0))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/movie/list', []))
        ;

        $this->getAdapter()->expects($this->at(1))
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/tv/list', []))
        ;

        $repository->loadCollection();
    }

    /**
     * @test
     */
    public function shouldLoadMovieCollection()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/movie/list', []))
        ;

        $repository->loadMovieCollection();
    }

    /**
     * @test
     */
    public function shouldLoadTvCollection()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/tv/list', []))
        ;

        $repository->loadTvCollection();
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/genre/' . self::GENRE_ID . '/movies', []))
        ;

        $repository->getMovies(self::GENRE_ID);
    }

    /**
     * @test
     */
    public function shouldGetFactory()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $this->assertInstanceOf('Tmdb\Factory\GenreFactory', $repository->getFactory());
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Genres';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\GenreRepository';
    }
}
