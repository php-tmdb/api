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

class CompaniesTest extends TestCase
{
    const COMPANY_ID = 1;

    /**
     * @test
     */
    public function shouldGetCompany()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('company/' . self::COMPANY_ID));

        $api->getCompany(self::COMPANY_ID);
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('company/' . self::COMPANY_ID. '/movies'));

        $api->getMovies(self::COMPANY_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Companies';
    }
}
