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
namespace Tmdb\Api;

use Tmdb\Client;

/**
 * Class AbstractApi
 * @package Tmdb\Api
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * The client
     *
     * @var Client
     */
    protected $client;

    /**
     * Constructor
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send a GET request
     *
     * @param  string $path
     * @param  array  $parameters
     * @param  array  $headers
     * @return mixed
     */
    public function get($path, array $parameters = [], $headers = [])
    {
        $response = $this->getClient()->getHttpClient()->get($path, $parameters, $headers);

        return $this->decodeResponse($response);
    }

    /**
     * Send a HEAD request
     *
     * @param $path
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function head($path, array $parameters = [], $headers = [])
    {
        $response = $this->getClient()->getHttpClient()->head($path, $parameters, $headers);

        return $this->decodeResponse($response);
    }

    /**
     * Send a POST request
     *
     * @param  string $path
     * @param  null   $postBody
     * @param  array  $parameters
     * @param  array  $headers
     * @return mixed
     */
    public function post($path, $postBody = null, array $parameters = [], $headers = [])
    {
        $response = $this->getClient()->getHttpClient()->post($path, $postBody, $parameters, $headers);

        return $this->decodeResponse($response);
    }

    /**
     * Send a PUT request
     *
     * @param $path
     * @param  null  $body
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function put($path, $body = null, array $parameters = [], $headers = [])
    {
        $response = $this->getClient()->getHttpClient()->put($path, $body, $parameters, $headers);

        return $this->decodeResponse($response);
    }

    /**
     * Send a DELETE request
     *
     * @param  string $path
     * @param  null   $body
     * @param  array  $parameters
     * @param  array  $headers
     * @return mixed
     */
    public function delete($path, $body = null, array $parameters = [], $headers = [])
    {
        $response = $this->getClient()->getHttpClient()->delete($path, $body, $parameters, $headers);

        return $this->decodeResponse($response);
    }

    /**
     * Send a PATCH request
     *
     * @param $path
     * @param  null  $body
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function patch($path, $body = null, array $parameters = [], $headers = [])
    {
        $response = $this->getClient()->getHttpClient()->patch($path, $body, $parameters, $headers);

        return $this->decodeResponse($response);
    }

    /**
     * Send a POST request but json_encode the post body in the request
     *
     * @param  string $path
     * @param  mixed  $postBody
     * @param  array  $parameters
     * @param  array  $headers
     * @return mixed
     */
    public function postJson($path, $postBody = null, array $parameters = [], $headers = [])
    {
        if (is_array($postBody)) {
            $postBody = json_encode($postBody);
        }

        return $this->post($path, $postBody, $parameters, $headers);
    }

    /**
     * Retrieve the client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Decode the response
     *
     * @param $response
     * @return mixed
     */
    private function decodeResponse($response)
    {
        return is_string($response) ? json_decode($response, true) : $response;
    }
}
