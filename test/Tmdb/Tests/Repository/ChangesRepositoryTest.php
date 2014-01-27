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

use Tmdb\Model\Query\ChangesQuery;

class ChangesRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetMovieChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $query = new ChangesQuery();

        $repository->getMovieChanges($query);
    }

    /**
     * @test
     */
    public function shouldGetPeopleChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $query = new ChangesQuery();

        $repository->getPeopleChanges($query);
    }

    /**
     * There is no generic factory for changes so it should never be called.
     *
     * @expectedException Tmdb\Exception\NotImplementedException
     * @test
     */
    public function getFactoryShouldThrowException()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();
        $repository->getFactory();
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Changes';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\ChangesRepository';
    }
}