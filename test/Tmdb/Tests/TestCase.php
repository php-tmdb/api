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

namespace Tmdb\Tests;

use Http\Discovery\Psr17FactoryDiscovery;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Client;
use Tmdb\Common\ObjectHydrator;
use Tmdb\Common\ParameterBag;
use Tmdb\Event\Listener\Request\AcceptJsonRequestListener;
use Tmdb\Event\Listener\Request\ApiTokenRequestListener;
use Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener;
use Tmdb\HttpClient\HttpClient;
use Tmdb\HttpClient\Request;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $psr18mock = null;

    protected $eventDispatcher = null;

    /**
     * Assert that an array of methods and corresponding classes match
     *
     * @param $subject
     * @param  array      $instances
     * @throws \Exception
     */
    protected function assertInstancesOf($subject, array $instances = [])
    {
        foreach ($instances as $method => $instance) {
            try {
                $this->assertInstanceOf($instance, $subject->$method());
            } catch (\Exception $e) {
                throw new \Exception(sprintf(
                    'Failed asserting that calling "%s" returns an instance of expected "%s".',
                    sprintf('%s::%s', get_class($subject), $method),
                    $instance
                ));
            }
        }
    }

    /**
     * Load an json file from the Resources directory
     *
     * @param $file
     * @return mixed
     */
    protected function loadByFile($file)
    {
        return json_decode(
            file_get_contents(
                sprintf(
                    '%s/%s',
                    'test/Tmdb/Tests/Resources/',
                    $file
                )
            ),
            true
        );
    }

    /**
     * Get a TMDB Client with an mocked HTTP dependency
     *
     * @param  array        $options
     * @return \Tmdb\Client
     */
    protected function getClientWithMockedHttpClient(array $options = array())
    {
        $options['event_dispatcher']['adapter'] = $this->eventDispatcher = new EventDispatcher();

        $options['api_token'] = new ApiToken('abcdef');
        $options['http']['client'] = new \Http\Mock\Client();
        $response = $this->createMock('Psr\Http\Message\ResponseInterface');
        $options['http']['client']->setDefaultResponse($response);

        $client = new Client($options);

        $requestListener = new RequestListener($client->getHttpClient(), $this->eventDispatcher);
        $apiTokenListener = new ApiTokenRequestListener($options['api_token']);
        $acceptJsonListener = new AcceptJsonRequestListener();
        $jsonContentTypeListener = new ContentTypeJsonRequestListener();

        $this->eventDispatcher->addListener(BeforeRequestEvent::class, $apiTokenListener);
        $this->eventDispatcher->addListener(BeforeRequestEvent::class, $acceptJsonListener);
        $this->eventDispatcher->addListener(BeforeRequestEvent::class, $jsonContentTypeListener);
        $this->eventDispatcher->addListener(RequestEvent::class, $requestListener);

        /**
         * We do not need api keys being added to the requests here.
         *
         * @var EventDispatcher
         */
        foreach ($client->getEventDispatcher()->getListeners() as $event => $listeners) {
            foreach ($listeners as $listener) {
                if ($listener instanceof ApiTokenRequestListener) {
                    $client->getEventDispatcher()->removeListener($event, $listener);
                }
            }
        }

        return $client;
    }

    public function getAdapterMock()
    {
        return $this->createMock('Tmdb\HttpClient\Adapter\AdapterInterface');
    }

    /**
     * Get TMDB Client
     *
     * @return Client
     */
    protected function getMockedTmdbClient()
    {
        $adapter = new \Http\Mock\Client();

        return $this->_client = new Client([
            'api_token' => new ApiToken('abcdef'),
            'http' => ['client' => $adapter],
            'event_dispatcher' => ['adapter' => new EventDispatcher()]
        ]);
    }

    /**
     * Get mocked http client
     *
     * @param  string                                   $baseUrl
     * @param  array                                    $options
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getHttpClientWithMockedAdapter($baseUrl, array $options = [])
    {
        return $this->_client = new HttpClient(
            $baseUrl,
            $options,
            $this->createMock('Tmdb\HttpClient\Adapter\AdapterInterface'),
            $this->createMock('Symfony\Component\EventDispatcher\EventDispatcher')
        );
    }

    /**
     * Get mocked http client
     *
     * @param  array                                    $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockedHttpClient(array $methods = [])
    {
        if (!in_array('send', $methods)) {
            $methods[] = 'send';
        }

        return $this->getMockBuilder('Guzzle\Http\Client')->setMethods($methods)->getMock();
    }

    /**
     * Get the expected request that will deliver a response
     *
     * @param  string  $url
     * @param  array   $parameters
     * @param  string  $method
     * @param  array   $headers
     * @param  null    $body
     * @return Request
     */
    protected function getRequest($url, $parameters = [], $method = 'GET', $headers = [], $body = null)
    {
        if (
            $method == 'POST'  ||
            $method == 'PUT'   ||
            $method == 'PATCH' ||
            $method == 'DELETE'
        ) {
            $headers['Content-Type'] = 'application/json';
        }

        $parameters['api_key'] = 'abcdef';

        $headers['Accept']     = 'application/json';
        $headers['User-Agent'] = sprintf('php-tmdb/api (v%s)', Client::VERSION);

        $baseUri = 'https://api.themoviedb.org/3/';
        if (strpos($url, $baseUri) === 0) {
            $path = substr($url, strlen($baseUri));
        } else {
            $path = $url;
        }

        $request = new Request(
            $path,
            $method,
            new ParameterBag($parameters),
            new ParameterBag($headers)
        );

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $request->setOptions(new ParameterBag([
            'token'   => new ApiToken('abcdef'),
            'secure'  => true,
            'cache'   => [
                'enabled' => false,
//                'adapter' => new FilesystemCache(sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-tmdb-api'),
                'path'    => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-tmdb-api',
                'subscriber' => null
            ],
            'log'     => [
                'enabled' => false,
                'level'   => 'debug',
                'adapter' => null,
                'path'    => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-tmdb-api.log',
                'subscriber' => null
            ],
            'http' => [
                'client' => new \Http\Mock\Client($responseFactory),
                'request_factory' => Psr17FactoryDiscovery::findRequestFactory(),
                'response_factory' => $responseFactory,
                'stream_factory' => Psr17FactoryDiscovery::findStreamFactory(),
                'uri_factory' => Psr17FactoryDiscovery::findUriFactory(),
            ],
            'host'    => 'api.themoviedb.org/3/',
            'base_uri' => $baseUri,
            'guest_session_token' => null,
            'event_dispatcher' => ['adapter' => $this->eventDispatcher]
        ]));

        if ($body !== null) {
            $request->setBody(is_array($body) ? json_encode($body) : $body);
        }

        return $request;
    }

    /**
     * Hydrate object
     *
     * @param $object
     * @param $data
     * @return \Tmdb\Model\AbstractModel
     */
    protected function hydrate($object, array $data = [])
    {
        $objectHydrator = new ObjectHydrator();

        return $objectHydrator->hydrate($object, $data);
    }
}
