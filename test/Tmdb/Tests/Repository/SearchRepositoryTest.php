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

use Tmdb\Exception\NotImplementedException;
use Tmdb\HttpClient\ResponseInterface;
use Tmdb\Model\Search\SearchQuery\CollectionSearchQuery;
use Tmdb\Model\Search\SearchQuery\CompanySearchQuery;
use Tmdb\Model\Search\SearchQuery\KeywordSearchQuery;
use Tmdb\Model\Search\SearchQuery\ListSearchQuery;
use Tmdb\Model\Search\SearchQuery\MovieSearchQuery;
use Tmdb\Model\Search\SearchQuery\PersonSearchQuery;
use Tmdb\Model\Search\SearchQuery\TvSearchQuery;
use Tmdb\Repository\SearchRepository;

class SearchRepositoryTest extends TestCase
{
    public const MOVIE_QUERY      = 'rush hour';
    public const COLLECTION_QUERY = 'the matrix';
    public const TV_QUERY         = 'breaking bad';
    public const PERSON_QUERY     = 'johnny knoxville';
    public const COMPANY_QUERY    = 'disney';
    public const KEYWORD_QUERY    = 'alien';
    public const MULTI_QUERY      = 'jack';

    /**
     * @test
     */
    public function shouldSearchMovie()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->searchMovie(self::MOVIE_QUERY, new MovieSearchQuery());
        $this->assertLastRequestIsWithPathAndMethod('/3/search/movie');
        $this->assertRequestHasQueryParameters(
            [
                'page' => 1,
                'query' => self::MOVIE_QUERY
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchCollection()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->searchCollection(self::COLLECTION_QUERY, new CollectionSearchQuery());
        $this->assertLastRequestIsWithPathAndMethod('/3/search/collection');
        $this->assertRequestHasQueryParameters(
            [
                'page' => 1,
                'query' => self::COLLECTION_QUERY
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchTv()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->searchTv(self::TV_QUERY, new TvSearchQuery());
        $this->assertLastRequestIsWithPathAndMethod('/3/search/tv');
        $this->assertRequestHasQueryParameters(
            [
                'page' => 1,
                'query' => self::TV_QUERY
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchPerson()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->searchPerson(self::PERSON_QUERY, new PersonSearchQuery());
        $this->assertLastRequestIsWithPathAndMethod('/3/search/person');
        $this->assertRequestHasQueryParameters(
            [
                'page' => 1,
                'query' => self::PERSON_QUERY
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchCompany()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->searchCompany(self::COMPANY_QUERY, new CompanySearchQuery());
        $this->assertLastRequestIsWithPathAndMethod('/3/search/company');
        $this->assertRequestHasQueryParameters(
            [
                'page' => 1,
                'query' => self::COMPANY_QUERY
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchKeyword()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->searchKeyword(self::KEYWORD_QUERY, new KeywordSearchQuery());
        $this->assertLastRequestIsWithPathAndMethod('/3/search/keyword');
        $this->assertRequestHasQueryParameters(
            [
                'page' => 1,
                'query' => self::KEYWORD_QUERY
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchMulti()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->searchMulti(self::MULTI_QUERY, new KeywordSearchQuery());
        $this->assertLastRequestIsWithPathAndMethod('/3/search/multi');
        $this->assertRequestHasQueryParameters(
            [
                'page' => 1,
                'query' => self::MULTI_QUERY
            ]
        );
    }

    /**
     * @test
     */
    public function shouldGetFactory()
    {
        $this->expectException(NotImplementedException::class);
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->getFactory();
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();
        $class      = new \stdClass();

        $repository->setMovieFactory($class);
        $repository->setCollectionFactory($class);
        $repository->setCompanyFactory($class);
        $repository->setKeywordFactory($class);
        $repository->setPeopleFactory($class);
        $repository->setTvFactory($class);

        $this->assertInstanceOf('stdClass', $repository->getMovieFactory());
        $this->assertInstanceOf('stdClass', $repository->getCollectionFactory());
        $this->assertInstanceOf('stdClass', $repository->getCompanyFactory());
        $this->assertInstanceOf('stdClass', $repository->getKeywordFactory());
        $this->assertInstanceOf('stdClass', $repository->getPeopleFactory());
        $this->assertInstanceOf('stdClass', $repository->getTvFactory());
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Search';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\SearchRepository';
    }
}
