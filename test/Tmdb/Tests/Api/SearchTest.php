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

class SearchTest extends TestCase
{
    const QUERY_MOVIE      = 'resident evil';
    const QUERY_COLLECTION = 'lord of the rings';
    const QUERY_TV         = 'the simpsons';
    const QUERY_PERSON     = 'vin diesel';
    const QUERY_LIST       = 'best of';
    const QUERY_COMPANY    = 'sony pictures';
    const QUERY_KEYWORD    = 'horror';

    /**
     * @test
     */
    public function shouldSearchMovies()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('search/movie', array('query' => urlencode(self::QUERY_MOVIE)));

        $api->searchMovies(self::QUERY_MOVIE);
    }

    /**
     * @test
     */
    public function shouldSearchCollection()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('search/collection', array('query' => urlencode(self::QUERY_COLLECTION)));

        $api->searchCollection(self::QUERY_COLLECTION);
    }

    /**
     * @test
     */
    public function shouldSearchTv()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('search/tv', array('query' => urlencode(self::QUERY_TV)));

        $api->searchTv(self::QUERY_TV);
    }

    /**
     * @test
     */
    public function shouldPersonCollection()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('search/person', array('query' => urlencode(self::QUERY_PERSON)));

        $api->searchPersons(self::QUERY_PERSON);
    }

    /**
     * @test
     */
    public function shouldSearchList()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('search/list', array('query' => urlencode(self::QUERY_LIST)));

        $api->searchList(self::QUERY_LIST);
    }

    /**
     * @test
     */
    public function shouldSearchCompany()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('search/company', array('query' => urlencode(self::QUERY_COMPANY)));

        $api->searchCompany(self::QUERY_COMPANY);
    }

    /**
     * @test
     */
    public function shouldSearchKeyword()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('search/keyword', array('query' => urlencode(self::QUERY_KEYWORD)));

        $api->searchKeyword(self::QUERY_KEYWORD);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Search';
    }
}
