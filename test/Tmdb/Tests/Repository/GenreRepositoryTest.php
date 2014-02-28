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
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->load(self::GENRE_ID);
    }

    /**
     * @test
     */
    public function shouldLoadCollection()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->loadCollection();
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

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
