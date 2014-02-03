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
namespace Tmdb\Tests\HttpClient;

use Guzzle\Common\Event;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Tests\TestCase;

class HttpClientTest extends TestCase
{
    /**
     * @var \Guzzle\Http\Client
     */
    private $guzzleMock;

    /**
     * @var TestApi
     */
    private $testApi;

    /**
     * @var HttpClient
     */
    private $client;

    public function setUp()
    {
        $this->guzzleMock = $this->getMockBuilder('Guzzle\Http\Client')
            ->setConstructorArgs(array('http://www.google.com/', array()))
            ->setMethods(array())
            ->getMock();

        $this->client  = new HttpClient('http://www.google.com', array(), $this->guzzleMock);
        $this->testApi = new TestApi($this->client);
    }

    /**
     * @test
     */
    public function shouldCallGet()
    {
        $this->setUp();

        $this->guzzleMock
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue($this->getMock('Guzzle\Http\Message\RequestInterface')))
        ;

        $this->testApi->get('/');
    }

    /**
     * @test
     */
    public function shouldCallHead()
    {
        $this->setUp();

        $this->guzzleMock
            ->expects($this->once())
            ->method('head')
            ->will($this->returnValue($this->getMock('Guzzle\Http\Message\RequestInterface')))
        ;

        $this->testApi->head('/');
    }

    /**
     * @test
     */
    public function shouldCallPost()
    {
        $this->setUp();

        $this->guzzleMock
            ->expects($this->once())
            ->method('post')
            ->will($this->returnValue($this->getMock('Guzzle\Http\Message\RequestInterface')))
        ;

        $this->testApi->post('/', array('name' => 'Henk'));
    }

    /**
     * @test
     */
    public function shouldCallPatch()
    {
        $this->setUp();

        $this->guzzleMock
            ->expects($this->once())
            ->method('patch')
            ->will($this->returnValue($this->getMock('Guzzle\Http\Message\RequestInterface')))
        ;

        $this->testApi->patch('/');
    }

    /**
     * @test
     */
    public function shouldCallDelete()
    {
        $this->setUp();

        $this->guzzleMock
            ->expects($this->once())
            ->method('delete')
            ->will($this->returnValue($this->getMock('Guzzle\Http\Message\RequestInterface')))
        ;

        $this->testApi->delete('/');
    }


    /**
     * @test
     */
    public function put()
    {
        $this->setUp();

        $this->guzzleMock
            ->expects($this->once())
            ->method('put')
            ->will($this->returnValue($this->getMock('Guzzle\Http\Message\RequestInterface')))
        ;

        $this->testApi->put('/');
    }

    /**
     * @test
     */
    public function shouldRegisterSubscribers()
    {
        $this->setUp();

        $this->guzzleMock
            ->expects($this->once())
            ->method('addSubscriber')
        ;

        $event = $this->getMock('Symfony\Component\EventDispatcher\EventSubscriberInterface');
        $this->testApi->addSubscriber($event);
    }

    /**
     * @test
     */
    public function shouldBeAbleToOverrideClient()
    {
        $httpClient = new HttpClient('http://google.nl', array(), new \Guzzle\Http\Client());

        $httpClient->setClient(new \stdClass());

        $this->assertInstanceOf('stdClass', $httpClient->getClient());
    }
}

class TestApi {
    /**
     * @var \Tmdb\HttpClient\HttpClient
     */
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function get() {
        $this->client->get('/');
    }

    public function head() {
        $this->client->head('/');
    }

    public function post() {
        $this->client->post('/', array('id' => 1));
    }

    public function patch() {
        $this->client->patch('http://www.google.com/');
    }

    public function delete() {
        $this->client->delete('http://www.google.com/');
    }

    public function put() {
        $this->client->put('http://www.google.com/');
    }

    public function addSubscriber($event) {
        $this->client->addSubscriber($event);
    }
}
