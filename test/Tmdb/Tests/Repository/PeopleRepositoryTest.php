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
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/person/' . self::PERSON_ID,
                ['append_to_response' => 'images,changes,combined_credits,movie_credits,tv_credits,external_ids,tagged_images']
            ))
        ;

        $repository->load(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function souldGetMovieCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/person/' . self::PERSON_ID . '/movie_credits'))
        ;

        $repository->getMovieCredits(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/person/' . self::PERSON_ID . '/external_ids'))
        ;

        $repository->getExternalIds(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/person/' . self::PERSON_ID . '/images'))
        ;

        $repository->getImages(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetChanges()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/person/' . self::PERSON_ID . '/changes'))
        ;

        $repository->getChanges(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetTaggedImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/person/' . self::PERSON_ID . '/tagged_images'))
        ;

        $repository->getTaggedImages(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function shouldGetPopular()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/person/popular'))
        ;

        $repository->getPopular();
    }

    /**
     * @test
     */
    public function shouldGetLatest()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/person/latest'))
        ;

        $repository->getLatest();
    }

    /**
     * @test
     */
    public function souldGetTvCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/person/' . self::PERSON_ID . '/tv_credits'))
        ;

        $repository->getTvCredits(self::PERSON_ID);
    }

    /**
     * @test
     */
    public function souldGetCombinedCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/person/' . self::PERSON_ID . '/combined_credits'))
        ;

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
