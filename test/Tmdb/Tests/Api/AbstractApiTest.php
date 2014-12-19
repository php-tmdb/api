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

use Tmdb\Api\AbstractApi;

class AbstractApiTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCallGet()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('get')
            ->with($this->getRequest('/', [], 'GET'))
        ;

        $api->get('/');
    }

    /**
     * @test
     */
    public function shouldCallHead()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('head')
            ->with($this->getRequest('/', [], 'HEAD'))
        ;

        $api->head('/');
    }

    /**
     * @test
     */
    public function shouldCallPost()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('post')
            ->with($this->getRequest('/', [], 'POST'))
        ;

        $api->post('/');
    }

    /**
     * @test
     */
    public function shouldCallPut()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('put')
            ->with($this->getRequest('/', [], 'PUT'))
        ;

        $api->put('/');
    }

    /**
     * @test
     */
    public function shouldCallDelete()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('delete')
            ->with($this->getRequest('/', [], 'DELETE'))
        ;

        $api->delete('/');
    }

    /**
     * @test
     */
    public function shouldCallPatch()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()
            ->expects($this->once())
            ->method('patch')
            ->with($this->getRequest('/', [], 'PATCH'))
        ;

        $api->patch('/');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Tests\Api\TestApi';
    }
}

class TestApi extends AbstractApi {}
