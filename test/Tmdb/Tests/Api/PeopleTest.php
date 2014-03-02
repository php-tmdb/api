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
namespace Tmdb\Tests\Api;

class PeopleTest extends TestCase
{
    const PERSON_ID = 287;

    /**
     * @test
     */
    public function shouldGetPerson()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('person/' . self::PERSON_ID);

        $api->getPerson(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('person/' . self::PERSON_ID . '/combined_credits');

        $api->getCredits(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetMovieCredits()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('person/' . self::PERSON_ID . '/movie_credits');

        $api->getMovieCredits(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetTvCredits()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('person/' . self::PERSON_ID . '/tv_credits');

        $api->getTvCredits(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('person/' . self::PERSON_ID . '/images');

        $api->getImages(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('person/' . self::PERSON_ID . '/changes');

        $api->getChanges(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('person/' . self::PERSON_ID . '/external_ids');

        $api->getExternalIds(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('person/popular');

        $api->getPopular();
    }

    /**
     * @test
     */
    public function shouldGetLatest()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('person/latest');

        $api->getLatest();
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\People';
    }
}
