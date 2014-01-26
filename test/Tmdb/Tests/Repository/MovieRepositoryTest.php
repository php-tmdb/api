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
    public function shouldGetLatestMovie()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getLatest();
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