<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
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
 * Class AbstractApi.
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * Constructor.
     */
    public function __construct(
        /**
         * The client.
         */
        protected \Tmdb\Client $client
    )
    {
    }

    /**
     * Send a GET request.
     */
    public function get(string $path, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'GET', $parameters, $headers),
        );
    }

    /**
     * Send a POST request.
     */
    public function post(string $path, $postBody = null, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'POST', $parameters, $headers, $postBody),
        );
    }

    /**
     * Send a POST request but json_encode the post body in the request.
     *
     * @throws InvalidArgumentException
     */
    public function postJson(string $path, $postBody = null, array $parameters = [], array $headers = []): array
    {
        try {
            if (\is_array($postBody)) {
                $postBody = json_encode($postBody, JSON_THROW_ON_ERROR);
            }

            return $this->post($path, $postBody, $parameters, $headers);
        } catch (JsonException $e) {
            throw new InvalidArgumentException('Unable to json_encode the data provided.', 0, $e);
        }
    }

    /**
     * Send a HEAD request.
     */
    public function head(string $path, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'HEAD', $parameters, $headers),
        );
    }

    /**
     * Send a PUT request.
     */
    public function put(string $path, $body = null, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'PUT', $parameters, $headers, $body),
        );
    }

    /**
     * Send a DELETE request.
     */
    public function delete(string $path, $body = null, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'DELETE', $parameters, $headers, $body),
        );
    }

    /**
     * Send a PATCH request.
     *
     * @param string|null $body
     */
    public function patch(string $path, $body = null, array $parameters = [], array $headers = []): array
    {
        return $this->decodeResponse(
            $this->getHttpClient()->send($path, 'PATCH', $parameters, $headers, $body),
        );
    }

    /**
     * Retrieve the client.
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Retrieve the http client.
     *
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->client->getHttpClient();
    }

    /**
     * Decode the response.
     *
     * @return array
     *
     * @throws UnexpectedResponseException
     */
    private function decodeResponse(ResponseInterface $response)
    {
        if (!$response->getBody() instanceof StreamInterface) {
            throw new UnexpectedResponseException('Response body is not a valid StreamInterface instance', $response->getStatusCode());
        }

        $body = (string) $response->getBody();

        // If the body is empty, we should still throw an exception
        // Empty responses are only acceptable for 204 No Content responses
        if ($body === '' || $body === '0') {
            if (204 === $response->getStatusCode()) {
                return [];
            }

            throw new UnexpectedResponseException(\sprintf('Empty response body with status code %d', $response->getStatusCode()), $response->getStatusCode());
        }

        try {
            // Decode any response with a valid JSON body, regardless of status code
            // This ensures we capture error details from 4xx/5xx responses
            return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new UnexpectedResponseException(\sprintf('Unable to decode response with body "%s", %s.', $body, json_last_error_msg()), $response->getStatusCode(), $e);
        }
    }
}
