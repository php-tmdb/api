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

use Tmdb\HttpClient\Response;
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
    const MOVIE_QUERY      = 'rush hour';
    const COLLECTION_QUERY = 'the matrix';
    const TV_QUERY         = 'breaking bad';
    const PERSON_QUERY     = 'johnny knoxville';
    const LIST_QUERY       = 'golden';
    const COMPANY_QUERY    = 'disney';
    const KEYWORD_QUERY    = 'alien';
    const MULTI_QUERY      = 'jack';

    /**
     * @test
     */
    public function shouldSearchMovie()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/search/movie',
                ['page' => 1, 'query' => self::MOVIE_QUERY]
            ))
        ;

        $repository->searchMovie(self::MOVIE_QUERY, new MovieSearchQuery());
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

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/search/collection',
                ['page' => 1, 'query' => self::COLLECTION_QUERY]
            ))
        ;

        $repository->searchCollection(self::COLLECTION_QUERY, new CollectionSearchQuery());
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

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/search/tv',
                ['page' => 1, 'query' => self::TV_QUERY]
            ))
        ;

        $repository->searchTv(self::TV_QUERY, new TvSearchQuery());
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

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/search/person',
                ['page' => 1, 'query' => self::PERSON_QUERY]
            ))
        ;

        $repository->searchPerson(self::PERSON_QUERY, new PersonSearchQuery());
    }

    /**
     * @test
     */
    public function shouldSearchList()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/search/list',
                ['page' => 1, 'query' => self::LIST_QUERY]
            ))
        ;

        $repository->searchList(self::LIST_QUERY, new ListSearchQuery());
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

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/search/company',
                ['page' => 1, 'query' => self::COMPANY_QUERY]
            ))
        ;

        $repository->searchCompany(self::COMPANY_QUERY, new CompanySearchQuery());
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

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/search/keyword',
                ['page' => 1, 'query' => self::KEYWORD_QUERY]
            ))
        ;

        $repository->searchKeyword(self::KEYWORD_QUERY, new KeywordSearchQuery());
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

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/search/multi',
                ['page' => 1, 'query' => self::MULTI_QUERY]
            ))
            ->will($this->returnValue(new Response(200, json_encode([
                'page' => 1,
                'total_pages' => 1,
                'total_results' => 3,
                'results' => json_decode('[{"backdrop_path":null,"id":9766,"original_name":"Jackpot","first_air_date":null,"origin_country":["US","CA"],"poster_path":null,"popularity":5.1137023644823e-40,"name":"Jackpot","vote_average":0,"vote_count":0,"media_type":"tv"},{"backdrop_path":null,"id":9766,"original_name":"Jackpot","first_air_date":null,"origin_country":["US","CA"],"poster_path":null,"popularity":5.1137023644823e-40,"name":"Jackpot","vote_average":0,"vote_count":0,"media_type":"tv"},{"backdrop_path":null,"id":9766,"original_name":"Jackpot","first_air_date":null,"origin_country":["US","CA"],"poster_path":null,"popularity":5.1137023644823e-40,"name":"Jackpot","vote_average":0,"vote_count":0,"media_type":"tv"}]', true)
            ]))))
        ;

        $collection = $repository->searchMulti(self::MULTI_QUERY, new KeywordSearchQuery());
        $this->assertEquals(3, $collection->count());
    }

    /**
     * @test
     */
    public function shouldReturnResultCollectionWhenResultIsNull()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest(
                'https://api.themoviedb.org/3/search/multi',
                ['page' => 1, 'query' => self::MULTI_QUERY]
            ))
            ->will($this->returnValue(null))
        ;

        $collection = $repository->searchMulti(self::MULTI_QUERY, new KeywordSearchQuery());
        $this->assertInstanceOf('\Tmdb\Model\Collection\ResultCollection', $collection);
        $this->assertEquals(0, $collection->count());
    }

    /**
     * @test
     * @expectedException Tmdb\Exception\NotImplementedException
     */
    public function shouldGetFactory()
    {
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
        $repository->setListItemFactory($class);
        $repository->setPeopleFactory($class);
        $repository->setTvFactory($class);

        $this->assertInstanceOf('stdClass', $repository->getMovieFactory());
        $this->assertInstanceOf('stdClass', $repository->getCollectionFactory());
        $this->assertInstanceOf('stdClass', $repository->getCompanyFactory());
        $this->assertInstanceOf('stdClass', $repository->getKeywordFactory());
        $this->assertInstanceOf('stdClass', $repository->getListItemFactory());
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
