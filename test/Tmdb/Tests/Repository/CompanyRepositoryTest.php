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

class CompanyRepositoryTest extends TestCase
{
    public const COMPANY_ID = 120;

    /**
     * @test
     */
    public function shouldLoadCompany()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->load(self::COMPANY_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/company/' . self::COMPANY_ID);
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getMovies(self::COMPANY_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/company/' . self::COMPANY_ID . '/movies');
    }

    /**
     * @test
     */
    public function callingGetMoviesWithFakeRequestWillReturnMovieCollection()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $collection = $repository->createMovieCollection(
            ['results' => [
                ['id' => 1],
                ['id' => 2]
            ]]
        );

        foreach ($collection as $movie) {
            $this->assertInstanceOf('Tmdb\Model\Movie', $movie);
        }
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Company';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\CompanyRepository';
    }
}
