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

class SearchTest extends TestCase
{
    public const QUERY_MOVIE = 'resident evil';
    public const QUERY_COLLECTION = 'lord of the rings';
    public const QUERY_TV = 'the simpsons';
    public const QUERY_PERSON = 'vin diesel';
    public const QUERY_COMPANY = 'sony pictures';
    public const QUERY_KEYWORD = 'horror';

    /**
     * @test
     */
    public function shouldSearchMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->searchMovies(self::QUERY_MOVIE);
        $this->assertLastRequestIsWithPathAndMethod('/3/search/movie');
        $this->assertRequestHasQueryParameters(
            [
                'query' => self::QUERY_MOVIE
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchCollection()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->searchCollection(self::QUERY_COLLECTION);
        $this->assertLastRequestIsWithPathAndMethod('/3/search/collection');
        $this->assertRequestHasQueryParameters(
            [
                'query' => self::QUERY_COLLECTION
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchTv()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->searchTv(self::QUERY_TV);
        $this->assertLastRequestIsWithPathAndMethod('/3/search/tv');
        $this->assertRequestHasQueryParameters(
            [
                'query' => self::QUERY_TV
            ]
        );
    }

    /**
     * @test
     */
    public function shouldPersonCollection()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->searchPersons(self::QUERY_PERSON);
        $this->assertLastRequestIsWithPathAndMethod('/3/search/person');
        $this->assertRequestHasQueryParameters(
            [
                'query' => self::QUERY_PERSON
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchCompany()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->searchCompany(self::QUERY_COMPANY);
        $this->assertLastRequestIsWithPathAndMethod('/3/search/company');
        $this->assertRequestHasQueryParameters(
            [
                'query' => self::QUERY_COMPANY
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchKeyword()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->searchKeyword(self::QUERY_KEYWORD);
        $this->assertLastRequestIsWithPathAndMethod('/3/search/keyword');
        $this->assertRequestHasQueryParameters(
            [
                'query' => self::QUERY_KEYWORD
            ]
        );
    }

    /**
     * @test
     */
    public function shouldSearchMulti()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->searchMulti(self::QUERY_KEYWORD);
        $this->assertLastRequestIsWithPathAndMethod('/3/search/multi');
        $this->assertRequestHasQueryParameters(
            [
                'query' => self::QUERY_KEYWORD
            ]
        );
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Search';
    }
}
