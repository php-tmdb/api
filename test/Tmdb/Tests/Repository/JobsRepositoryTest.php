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

class JobsRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldForwardLoad()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/job/list', []))
        ;

        $repository->load();
    }

    /**
     * @test
     */
    public function shouldLoadCollection()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/job/list', []))
        ;

        $repository->loadCollection();
    }

    /**
     * @test
     */
    public function shouldGetFactory()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $this->assertInstanceOf('Tmdb\Factory\JobsFactory', $repository->getFactory());
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Jobs';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\JobsRepository';
    }
}
