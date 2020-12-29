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

namespace Tmdb\Tests\Api;

class PeopleTest extends TestCase
{
    public const PERSON_ID = 287;

    /**
     * @test
     */
    public function shouldGetPerson()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getPerson(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCredits(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/combined_credits');
    }

    /**
     * @test
     */
    public function shouldGetMovieCredits()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getMovieCredits(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/movie_credits');
    }

    /**
     * @test
     */
    public function shouldGetTvCredits()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTvCredits(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/tv_credits');
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getImages(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/images');
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getChanges(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/changes');
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getExternalIds(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/external_ids');
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getPopular();
        $this->assertLastRequestIsWithPathAndMethod('/3/person/popular');
    }

    /**
     * @test
     */
    public function shouldGetLatest()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getLatest();
        $this->assertLastRequestIsWithPathAndMethod('/3/person/latest');
    }

    /**
     * @test
     */
    public function shouldGetTaggedImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTaggedImages(self::PERSON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/person/' . self::PERSON_ID . '/tagged_images');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\People';
    }
}
