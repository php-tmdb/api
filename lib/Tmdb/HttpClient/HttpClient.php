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
namespace Tmdb\HttpClient;

use Guzzle\Http\ClientInterface;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Message\Response;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class HttpClient
    implements HttpClientInterface
{
    /**
     * @var \Guzzle\Http\ClientInterface
     */
    private $client;

    protected $options  = array();
    protected $base_url = null;
    protected $headers  = array();

    /**
     * @var Response
     */
    private $lastResponse;

    /**
     * @var Request
     */
    private $lastRequest;

    /**
     * Constructor
     *
     * @param string $baseUrl
     * @param array $options
     * @param ClientInterface $client
     */
    public function __construct($baseUrl, array $options, ClientInterface $client)
    {
        $this->base_url = $baseUrl;
        $this->options  = $options;
        $this->client   = $client;

        $this->clearHeaders();
    }

    /**
     * Add a subscriber
     *
     * @param EventSubscriberInterface $subscriber
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->client->addSubscriber($subscriber);
    }

    /**
     * Clear up the headers
     * @return void
     */
    public function clearHeaders()
    {
        $this->headers = array();
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers = array())
    {
        $this->headers = $headers;
    }

    /**
     * Set options
     *
     * @param string $key
     * @param mixed $value
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * Get an option
     *
     * @param $key
     * @return mixed
     */
    public function getOption($key)
    {
        return $this->options[$key];
    }

    /**
     * Set the query parameters
     *
     * @param $queryParameters
     * @return array
     */
    protected function buildQueryParameters($queryParameters)
    {
        return array_merge($this->options, array('query' => $queryParameters));
    }

    /**
     * {@inheritDoc}
     */
    public function get($path, array $parameters = array(), array $headers = array())
    {
        $parameters = $this->buildQueryParameters($parameters);

        return $this->request(
            $this->client->get($path, $headers, $parameters)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function head($path, array $parameters = array(), array $headers = array())
    {
        $parameters = $this->buildQueryParameters($parameters);

        return $this->request(
            $this->client->head($path, $headers, $parameters)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function post($path, $postBody, array $parameters = array(), array $headers = array())
    {
        $parameters = $this->buildQueryParameters($parameters);

        return $this->request(
            $this->client->post($path, $headers, $postBody, $parameters)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function patch($path, $body = null, array $parameters = array(), array $headers = array())
    {
        $parameters = $this->buildQueryParameters($parameters);

        return $this->request(
            $this->client->patch($path, $headers, $body, $parameters)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function delete($path, $body = null, array $parameters = array(), array $headers = array())
    {
        $parameters = $this->buildQueryParameters($parameters);

        return $this->request(
            $this->client->delete($path, $headers, $body, $parameters)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function put($path, $body = null, array $parameters = array(), array $headers = array())
    {
        $parameters = $this->buildQueryParameters($parameters);

        return $this->request(
            $this->client->put($path, $headers, $body, $parameters)
        );
    }

    /**
     * @{inheritDoc}
     */
    public function request(RequestInterface $request)
    {
        $response = null;

        try {
            $response = $request->send();
        }
        catch(\Exception $e)
        {
            // @TODO catch any API errors / timeouts / other specific information from Guzzle?
            throw $e;
        }

        $this->lastRequest  = $request;
        $this->lastResponse = $response;

        return $response;
    }

    /**
     * @param \Guzzle\Http\ClientInterface $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return \Guzzle\Http\ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }
}