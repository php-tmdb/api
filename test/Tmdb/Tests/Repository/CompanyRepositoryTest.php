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

class CompanyRepositoryTest extends TestCase
{
    const COMPANY_ID = 120;

    /**
     * @test
     */
    public function shouldLoadCompany()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('company/' . self::COMPANY_ID, []))
        ;

        $repository->load(self::COMPANY_ID);
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('company/'.self::COMPANY_ID.'/movies'))
        ;

        $repository->getMovies(self::COMPANY_ID);
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
