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

use Tmdb\Api\AbstractApi;

class AbstractApiTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCallGet()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->get('');
        $this->assertLastRequestIsWithPathAndMethod('/3/', 'GET');
    }

    /**
     * @test
     */
    public function shouldCallHead()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->head('');
        $this->assertLastRequestIsWithPathAndMethod('/3/', 'HEAD');
    }

    /**
     * @test
     */
    public function shouldCallPost()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->post('');
        $this->assertLastRequestIsWithPathAndMethod('/3/', 'POST');
    }

    /**
     * @test
     */
    public function shouldCallPut()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->put('');
        $this->assertLastRequestIsWithPathAndMethod('/3/', 'PUT');
    }

    /**
     * @test
     */
    public function shouldCallDelete()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->delete('');
        $this->assertLastRequestIsWithPathAndMethod('/3/', 'DELETE');
    }

    /**
     * @test
     */
    public function shouldCallPatch()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->patch('');
        $this->assertLastRequestIsWithPathAndMethod('/3/', 'PATCH');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Tests\Api\TestApi';
    }
}

class TestApi extends AbstractApi
{
}
