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

    public function setUp() :void
    {
        $this->adapter = $this->createMock('Tmdb\HttpClient\Adapter\AdapterInterface');

        $this->client  = new Client(new ApiToken('abcdef'), ['adapter' => $this->adapter]);
        $this->testApi = new TestApi($this->client);
    }

    /**
     * @test
     */
    public function shouldCallGet()
    {
        $this->setUp();
        $this->adapter
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
        $this->adapter
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

        $this->adapter
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


        $this->adapter
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


        $this->adapter
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
        $this->adapter
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
            'adapter'          => $this->adapter,
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
            'adapter'          => $this->adapter,
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

    /**
     * @test
     */
    public function shouldBeAbleToOverrideAdapter()
    {
        $httpClient = new HttpClient([
            'host'             => 'google.com',
            'adapter'          => $this->createMock('\Tmdb\HttpClient\Adapter\AdapterInterface'),
            'event_dispatcher' => new EventDispatcher(),
            'session_token'    => null,
            'cache'            => null,
            'log'              => null
        ]);

        $this->assertInstanceOf('Tmdb\HttpClient\Adapter\AdapterInterface', $httpClient->getAdapter());
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
        $this->client->getHttpClient()->get('/');
    }

    public function head($path, array $parameters = [], $headers = [])
    {
        $this->client->getHttpClient()->head('/');
    }

    public function post($path, $postBody = null, array $parameters = [], $headers = [])
    {
        $this->client->getHttpClient()->post('/', ['id' => 1]);
    }

    public function patch($path, $body = null, array $parameters = [], $headers = [])
    {
        $this->client->getHttpClient()->patch('http://www.google.com/');
    }

    public function delete($path, $body = null, array $parameters = [], $headers = [])
    {
        $this->client->getHttpClient()->delete('http://www.google.com/');
    }

    public function put($path, $body = null, array $parameters = [], $headers = [])
    {
        $this->client->getHttpClient()->put('http://www.google.com/');
    }

    public function addSubscriber($event)
    {
        $this->client->getHttpClient()->addSubscriber($event);
    }

    public function removeSubscriber($event)
    {
        $this->client->getHttpClient()->removeSubscriber($event);
    }
}
