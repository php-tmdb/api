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

class CertificationRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldLoadMovieCertifications()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('certification/movie/list'))
        ;

        $repository->getMovieList();
    }

    /**
     * @test
     */
    public function shouldLoadTvCertifications()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('certification/tv/list'))
        ;

        $repository->getTvList();
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Certification';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\CertificationRepository';
    }
}
