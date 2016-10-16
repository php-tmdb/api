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
namespace Tmdb\Tests\HttpClient\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use Tmdb\ApiToken;
use Tmdb\Exception\NullResponseException;
use Tmdb\HttpClient\Adapter\GuzzleAdapter;
use Tmdb\HttpClient\Request;
use Tmdb\Tests\TestCase;

class GuzzleAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGet()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->returnValue(new Response(200)))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->get(new Request());
    }

    /**
     * @test
     */
    public function shouldPost()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->returnValue(new Response(200)))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->post(new Request());
    }

    /**
     * @test
     */
    public function shouldPut()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->returnValue(new Response(200)))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->put(new Request());
    }

    /**
     * @test
     */
    public function shouldDelete()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->returnValue(new Response(200)))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->delete(new Request());
    }

    /**
     * @test
     */
    public function shouldPatch()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->returnValue(new Response(200)))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->patch(new Request());
    }

    /**
     * @test
     */
    public function shouldHead()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->returnValue(new Response(200)))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->head(new Request());
    }

    /**
     * @expectedException \Tmdb\Exception\TmdbApiException
     * @test
     */
    public function shouldThrowExceptionForGet()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->throwException(
                new RequestException(
                    '404',
                    new \GuzzleHttp\Psr7\Request('get', '/'),
                    new Response(404, [], json_encode([
                        'status_code' => 15,
                        'status_message' => 'Something went wrong'
                    ]))
                )
            ))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->get(new Request());
    }

    /**
     * @expectedException \Tmdb\Exception\TmdbApiException
     * @test
     */
    public function shouldThrowExceptionForPost()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->throwException(
                new RequestException(
                    '404',
                    new \GuzzleHttp\Psr7\Request('post', '/'),
                    new Response(404, [], json_encode([
                        'status_code' => 15,
                        'status_message' => 'Something went wrong'
                    ]))
                )
            ))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->post(new Request());
    }

    /**
     * @expectedException \Tmdb\Exception\TmdbApiException
     * @test
     */
    public function shouldThrowExceptionForHead()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->throwException(
                new RequestException(
                    '404',
                    new \GuzzleHttp\Psr7\Request('head', '/'),
                    new Response(404, [], json_encode([
                        'status_code' => 15,
                        'status_message' => 'Something went wrong'
                    ]))
                )
            ))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->head(new Request());
    }

    /**
     * @expectedException \Tmdb\Exception\TmdbApiException
     * @test
     */
    public function shouldThrowExceptionForPatch()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->throwException(
                new RequestException(
                    '404',
                    new \GuzzleHttp\Psr7\Request('patch', '/'),
                    new Response(404, [], json_encode([
                        'status_code' => 15,
                        'status_message' => 'Something went wrong'
                    ]))
                )
            ))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->patch(new Request());
    }

    /**
     * @expectedException \Tmdb\Exception\TmdbApiException
     * @test
     */
    public function shouldThrowExceptionForPut()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->throwException(
                new RequestException(
                    '404',
                    new \GuzzleHttp\Psr7\Request('put', '/'),
                    new Response(404, [], json_encode([
                        'status_code' => 15,
                        'status_message' => 'Something went wrong'
                    ]))
                )
            ))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->put(new Request());
    }

    /**
     * @expectedException \Tmdb\Exception\TmdbApiException
     * @test
     */
    public function shouldThrowExceptionForDelete()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->throwException(
                new RequestException(
                    '404',
                    new \GuzzleHttp\Psr7\Request('delete', '/'),
                    new Response(404, [], json_encode([
                        'status_code' => 15,
                        'status_message' => 'Something went wrong'
                    ]))
                )
            ))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->delete(new Request());
    }

    /**
     * @expectedException \Tmdb\Exception\NullResponseException
     * @test
     */
    public function shouldThrowNullResponseException()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->throwException(
                new RequestException(
                    '404',
                    new \GuzzleHttp\Psr7\Request('get', '/'),
                    null
                )
            ))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->get(new Request());
    }

    /**
     * @expectedException \Tmdb\Exception\NullResponseException
     * @test
     */
    public function shouldThrowExceptionForServerError()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->throwException(
                new RequestException(
                    '500',
                    new \GuzzleHttp\Psr7\Request('GET', '/'),
                    new Response(500, [], '<html><body>Internal Server Error</body></html>')
                )
            ))
        ;

        $adapter = new GuzzleAdapter($client);
        $adapter->get(new Request('/'));
    }

    /**
     * @test
     */
    public function shouldFormatMessageForAnGuzzleHttpRequestException()
    {
        $client = $this->createMock('GuzzleHttp\ClientInterface');

        $client->expects($this->once())
            ->method('request')
            ->will($this->throwException(
                new RequestException(
                    '404',
                    new \GuzzleHttp\Psr7\Request('get', '/'),
                    null
                )
            ))
        ;

        $adapter = new GuzzleAdapter($client);

        try {
            $adapter->get(new Request());
        } catch (NullResponseException $e) {
            $this->assertEquals(true, false !== strpos($e->getMessage(), 'previous exception'));
        }
    }

    /**
     * @test
     */
    public function shouldAddCachePluginWhenEnabled()
    {
        $token  = new ApiToken('abc');
        $client = new \Tmdb\Client($token);

        /** @var Client $client */
        $client = $client->getHttpClient()->getAdapter()->getClient();

        /** @var HandlerStack $handler */
        $handler = $client->getConfig('handler');

        $this->assertTrue(false !== strpos((string) $handler, 'tmdb-cache'));
    }

    /**
     * @test
     */
    public function shouldAddLoggingPluginWhenEnabled()
    {
        $token  = new ApiToken('abc');
        $client = new \Tmdb\Client($token, [
            'log' => [
                'enabled' => true,
                'path'    => '/tmp/php-tmdb-api.log'
            ]
        ]);

        /** @var Client $client */
        $client = $client->getHttpClient()->getAdapter()->getClient();

        /** @var HandlerStack $handler */
        $handler = $client->getConfig('handler');

        $this->assertTrue(false !== strpos((string) $handler, 'tmdb-log'));
    }


    /**
     * @test
     */
    public function shouldCreateDefaultClientIfNotGiven()
    {
        $adapter = new GuzzleAdapter();

        $this->assertInstanceOf('GuzzleHttp\ClientInterface', $adapter->getClient());
    }

    /**
     * @test
     */
    public function shouldBeAbleToOverrideClient()
    {
        $adapter = new GuzzleAdapter();
        $adapter->setClient(new BleepHttp());

        $this->assertInstanceOf('\Tmdb\Tests\HttpClient\Adapter\BleepHttp', $adapter->getClient());
    }
}

class BleepHttp extends Client {}
