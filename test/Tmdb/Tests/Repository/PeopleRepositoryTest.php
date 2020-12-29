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

class PeopleRepositoryTest extends TestCase
{
    public const PERSON_ID = 287;

    /**
     * @test
     */
    public function shouldLoadPerson()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->load(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID);
        $this->assertRequestHasQueryParameters(['append_to_response' => 'images,changes,combined_credits,movie_credits,tv_credits,external_ids,tagged_images']);
    }

    /**
     * @test
     */
    public function shouldGetMovieCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getMovieCredits(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/movie_credits');
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getExternalIds(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/external_ids');
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getImages(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/images');
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getChanges(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/changes');
    }

    /**
     * @test
     */
    public function shouldGetTaggedImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getTaggedImages(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/tagged_images');
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getPopular();
        $this->assertLastRequestIsWithPathAndMethod('/3/person/popular');
    }

    /**
     * @test
     */
    public function shouldGetLatest()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getLatest();
        $this->assertLastRequestIsWithPathAndMethod('/3/person/latest');
    }

    /**
     * @test
     */
    public function souldGetTvCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getTvCredits(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/tv_credits');
    }

    /**
     * @test
     */
    public function shouldGetCombinedCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getCombinedCredits(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/combined_credits');
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
