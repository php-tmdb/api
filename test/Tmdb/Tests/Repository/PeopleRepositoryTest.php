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

class PeopleRepositoryTest extends TestCase
{
    const PERSON_ID = 287;

    /**
     * @test
     */
    public function shouldLoadPerson()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->load(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function souldGetMovieCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getMovieCredits(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function souldGetTvCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getTvCredits(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function souldGetCombinedCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getCombinedCredits(self::PERSON_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\People';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\PeopleRepository';
    }
}
