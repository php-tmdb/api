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
    /**
     * @test
     */
    public function shouldSearchMovie()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->searchMovie('rush hour', new MovieSearchQuery());
    }

    /**
     * @test
     */
    public function shouldSearchCollection()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->searchCollection('the matrix', new CollectionSearchQuery());
    }

    /**
     * @test
     */
    public function shouldSearchTv()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->searchTv('breaking bad', new TvSearchQuery());
    }

    /**
     * @test
     */
    public function shouldSearchPerson()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->searchPerson('johnny knoxville', new PersonSearchQuery());
    }

    /**
     * @test
     */
    public function shouldSearchList()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->searchList('golden', new ListSearchQuery());
    }

    /**
     * @test
     */
    public function shouldSearchCompany()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->searchCompany('disney', new CompanySearchQuery());
    }

    /**
     * @test
     */
    public function shouldSearchKeyword()
    {
        /**
         * @var SearchRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->searchKeyword('alien', new KeywordSearchQuery());
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
