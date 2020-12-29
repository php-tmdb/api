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

class FindRepositoryTest extends TestCase
{
    public const FIND_QUERY = 'tt2345737';

    /**
     * @test
     */
    public function shouldGetMovieChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->findBy(self::FIND_QUERY);
        $this->assertLastRequestIsWithPathAndMethod('/3/find/' . self::FIND_QUERY);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\FindApi';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\FindRepository';
    }
}
