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

use Tmdb\Api\AbstractApi;
use Tmdb\ApiToken;
use Tmdb\Client;
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
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->guzzleMock = $this->getMockBuilder('Guzzle\Http\Client')
            ->setConstructorArgs(array('http://www.google.com/', array()))
            ->setMethods(array())
            ->getMock();

        $this->client  = new Client(new ApiToken('abcdef'), $this->guzzleMock);
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
    public function shouldCallPut()
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

class TestApi extends AbstractApi
{
    /**
     * @var \Tmdb\HttpClient\HttpClient
     */
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function get($path, array $parameters = array(), $headers = array())
    {
        $this->client->getHttpClient()->get('/');
    }

    public function head($path, array $parameters = array(), $headers = array())
    {
        $this->client->getHttpClient()->head('/');
    }

    public function post($path, $postBody = null, array $parameters = array(), $headers = array())
    {
        $this->client->getHttpClient()->post('/', array('id' => 1));
    }

    public function patch($path, $body = null, array $parameters = array(), $headers = array())
    {
        $this->client->getHttpClient()->patch('http://www.google.com/');
    }

    public function delete($path, $body = null, array $parameters = array(), $headers = array())
    {
        $this->client->getHttpClient()->delete('http://www.google.com/');
    }

    public function put($path, $body = null, array $parameters = array(), $headers = array())
    {
        $this->client->getHttpClient()->put('http://www.google.com/');
    }

    public function addSubscriber($event)
    {
        $this->client->getHttpClient()->addSubscriber($event);
    }
}
