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

namespace Tmdb\Tests\HttpClient;

use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Tmdb\Api\AbstractApi;
use Tmdb\ApiToken;
use Tmdb\Client;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Tests\TestCase;

class HttpClientTest extends TestCase
{
    /**
     * @var TestApi
     */
    private $testApi;

    /**
     * @var Client
     */
    private $client;

    public function setUp(): void
    {
        $this->psr18mock = new \Http\Mock\Client();
        $this->client  = new Client(
            new ApiToken('abcdef'),
            [
                'http' => [
                    'client' => $this->psr18mock
                ]
            ]
        );
        $this->testApi = new TestApi($this->client);
    }

    /**
     * @test
     */
    public function shouldCallGet()
    {
        $this->setUp();
        $this->psr18mock
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue([]))
        ;

        $this->testApi->get('/');
    }

    /**
     * @test
     */
    public function shouldCallHead()
    {

        $this->setUp();
        $this->psr18mock
            ->expects($this->once())
            ->method('head')
            ->will($this->returnValue([]))
        ;

        $this->testApi->head('/');
    }

    /**
     * @test
     */
    public function shouldCallPost()
    {
        $this->setUp();

        $this->psr18mock
            ->expects($this->once())
            ->method('post')
            ->will($this->returnValue([]))
        ;

        $this->testApi->post('/', ['name' => 'Henk']);
    }

    /**
     * @test
     */
    public function shouldCallPatch()
    {
        $this->setUp();


        $this->psr18mock
            ->expects($this->once())
            ->method('patch')
            ->will($this->returnValue([]))
        ;

        $this->testApi->patch('/');
    }

    /**
     * @test
     */
    public function shouldCallDelete()
    {


        $this->psr18mock
            ->expects($this->once())
            ->method('delete')
            ->will($this->returnValue([]))
        ;

        $this->testApi->delete('/');
    }

    /**
     * @test
     */
    public function shouldCallPut()
    {

        $this->setUp();
        $this->psr18mock
            ->expects($this->once())
            ->method('put')
            ->will($this->returnValue([]))
        ;

        $this->testApi->put('/');
    }

    /**
     * @test
     */
    public function shouldRegisterSubscribers()
    {
        $this->eventDispatcher = $this->createMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->client  = new Client(new ApiToken('abcdef'), [
            'http' => [
                'client' => $this->psr18mock
            ],
            'event_dispatcher' => $this->eventDispatcher
        ]);
        $this->testApi = new TestApi($this->client);

        $this->eventDispatcher
            ->expects($this->once())
            ->method('addSubscriber')
        ;

        $subscriber = $this->createMock('Symfony\Component\EventDispatcher\EventSubscriberInterface');
        $this->testApi->addSubscriber($subscriber);
    }

    /**
     * @test
     */
    public function shouldDeregisterSubscribers()
    {
        $this->eventDispatcher = $this->createMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->client  = new Client(new ApiToken('abcdef'), [
            'http' => [
                'client' => $this->psr18mock
            ],
            'event_dispatcher' => $this->eventDispatcher
        ]);
        $this->testApi = new TestApi($this->client);

        $this->eventDispatcher
            ->expects($this->once())
            ->method('addSubscriber')
        ;

        $this->eventDispatcher
            ->expects($this->once())
            ->method('removeSubscriber')
        ;

        $subscriber = $this->createMock('Symfony\Component\EventDispatcher\EventSubscriberInterface');
        $this->testApi->addSubscriber($subscriber);
        $this->testApi->removeSubscriber($subscriber);
    }
}

class TestApi extends AbstractApi
{
    /**
     * @var \Tmdb\HttpClient\HttpClient
     */
    protected $client;

    public function __construct($client)
    {
        parent::__construct($client);
        $this->client = $client;
    }

    public function get($path, array $parameters = [], $headers = [])
    {
        $this->client->get('/');
    }

    public function head($path, array $parameters = [], $headers = [])
    {
        $this->client->head('/');
    }

    public function post($path, $postBody = null, array $parameters = [], $headers = [])
    {
        $this->client->post('/', ['id' => 1]);
    }

    public function patch($path, $body = null, array $parameters = [], $headers = [])
    {
        $this->client->patch('http://www.google.com/');
    }

    public function delete($path, $body = null, array $parameters = [], $headers = [])
    {
        $this->client->delete('http://www.google.com/');
    }

    public function put($path, $body = null, array $parameters = [], $headers = [])
    {
        $this->client->put('http://www.google.com/');
    }

    public function addSubscriber($event)
    {
        $this->client->addSubscriber($event);
    }

    public function removeSubscriber($event)
    {
        $this->client->removeSubscriber($event);
    }
}
