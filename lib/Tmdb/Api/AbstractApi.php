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

namespace Tmdb\Api;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Tmdb\Client;
use Tmdb\Exception\InvalidArgumentException;
use Tmdb\Exception\UnexpectedResponseException;
use Tmdb\HttpClient\HttpClient;

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
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return array
     */
    public function get(string $path, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'GET', $parameters, $headers)
        );
    }

    /**
     * Send a POST request
     *
     * @param string $path
     * @param null $postBody
     * @param array $parameters
     * @param array $headers
     * @return array
     */
    public function post(string $path, $postBody = null, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'POST', $parameters, $headers, $postBody)
        );
    }

    /**
     * Send a POST request but json_encode the post body in the request
     *
     * @param string $path
     * @param mixed $postBody
     * @param array $parameters
     * @param array $headers
     * @return array
     * @throws InvalidArgumentException
     */
    public function postJson(string $path, $postBody = null, array $parameters = [], array $headers = []): array
    {
        try {
            if (is_array($postBody)) {
                $postBody = json_encode($postBody, JSON_THROW_ON_ERROR);
            }

            return $this->post($path, $postBody, $parameters, $headers);
        } catch (JsonException $e) {
            throw new InvalidArgumentException(
                'Unable to json_encode the data provided.',
                0,
                $e
            );
        }
    }

    /**
     * Send a HEAD request
     *
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return array
     */
    public function head(string $path, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'HEAD', $parameters, $headers)
        );
    }

    /**
     * Send a PUT request
     *
     * @param string $path
     * @param null $body
     * @param array $parameters
     * @param array $headers
     * @return array
     */
    public function put(string $path, $body = null, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'PUT', $parameters, $headers, $body)
        );
    }

    /**
     * Send a DELETE request
     *
     * @param string $path
     * @param null $body
     * @param array $parameters
     * @param array $headers
     * @return array
     */
    public function delete(string $path, $body = null, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'DELETE', $parameters, $headers, $body)
        );
    }

    /**
     * Send a PATCH request
     *
     * @param string $path
     * @param string|null $body
     * @param array $parameters
     * @param array $headers
     * @return array
     */
    public function patch(string $path, $body = null, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'PATCH', $parameters, $headers, $body)
        );
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
     * Retrieve the http client
     *
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->client->getHttpClient();
    }

    /**
     * Decode the response
     *
     * @param ResponseInterface $response
     * @return array
     */
    private function decodeResponse(ResponseInterface $response)
    {
        try {
            if ($response->getBody() instanceof StreamInterface) {
                return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            }

            return [];
        } catch (JsonException $e) {
            throw new UnexpectedResponseException(
                sprintf(
                    'Unable to decode response with body "%s", %s.',
                    (string)$response->getBody(),
                    json_last_error_msg()
                ),
                $response->getStatusCode(),
                $e
            );
        }
    }
}
