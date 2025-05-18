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

use PHPUnit\Framework\Attributes\Test;

use Tmdb\Model\Query\ChangesQuery;

class ChangesRepositoryTest extends TestCase
{
    /**
     * */
    #[Test]
    public function shouldGetMovieChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $query = new ChangesQuery();

        $repository->getMovieChanges($query);
        $this->assertLastRequestIsWithPathAndMethod('/3/movie/changes');
    }

    /**
     * */
    #[Test]
    public function shouldGetPeopleChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $query = new ChangesQuery();

        $repository->getPeopleChanges($query);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/changes');
    }

    /**
     * */
    #[Test]
    public function shouldGetTvChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $query = new ChangesQuery();

        $repository->getTvChanges($query);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/changes');
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
