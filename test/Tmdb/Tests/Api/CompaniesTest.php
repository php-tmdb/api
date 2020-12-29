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

class CompaniesTest extends TestCase
{
    public const COMPANY_ID = 1;

    /**
     * @test
     */
    public function shouldGetCompany()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCompany(self::COMPANY_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/company/' . self::COMPANY_ID);
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getMovies(self::COMPANY_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/company/' . self::COMPANY_ID . '/movies');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Companies';
    }
}
