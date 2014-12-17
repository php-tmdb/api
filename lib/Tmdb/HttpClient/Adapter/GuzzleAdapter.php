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
namespace Tmdb\HttpClient\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\Response;
use Tmdb\Common\ParameterBag;
use Tmdb\Exception\TmdbApiException;
use Tmdb\HttpClient\Request;

class GuzzleAdapter extends AbstractAdapter
{
    /**
     * @var Client
     */
    private $client;

    public function __construct($options)
    {
        $this->client = new Client($options);
    }

    /**
     * Format the request for Guzzle
     *
     * @param  Request $request
     * @return array
     */
    public function getConfiguration(Request $request)
    {
        return [
            'headers'  => (array) $request->getHeaders(),
            'query'    => (array) $request->getParameters()
        ];
    }

    /**
     * Create the response object
     *
     * @param  Response                  $adapterResponse
     * @return \Tmdb\HttpClient\Response
     */
    private function createResponse(Response $adapterResponse)
    {
        $response = new \Tmdb\HttpClient\Response();

        $response->setCode($adapterResponse->getStatusCode());
        $response->setHeaders(new ParameterBag($adapterResponse->getHeaders()));
        $response->setBody((string) $adapterResponse->getBody());

        return $response;
    }

    /**
     * Create the unified exception to throw
     *
     * @param  Request                   $request
     * @param  \Tmdb\HttpClient\Response $response
     * @return TmdbApiException
     */
    private function createApiException(Request $request, \Tmdb\HttpClient\Response $response)
    {
        $errors = json_decode((string) $response->getBody());

        return new TmdbApiException(
            $errors->status_code,
            $errors->status_message,
            $request,
            $response
        );
    }

    /**
     * {@inheritDoc}
     */
    public function get(Request $request)
    {
        try {
            $response = $this->client->get(
                $request->getPath(),
                $this->getConfiguration($request)
            );
        } catch (RequestException $e) {
            throw $this->createApiException($request, $this->createResponse($e->getResponse()));
        }

        return $this->createResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function post(Request $request)
    {
        try {
            $response = $this->client->post(
                $request->getPath(),
                array_merge(
                    ['body' => $request->getBody()],
                    $this->getConfiguration($request)
                )
            );
        } catch (RequestException $e) {
            throw $this->createApiException($request, $this->createResponse($e->getResponse()));
        }

        return $this->createResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function put(Request $request)
    {
        try {
            $response = $this->client->put(
                $request->getPath(),
                array_merge(
                    ['body' => $request->getBody()],
                    $this->getConfiguration($request)
                )
            );
        } catch (RequestException $e) {
            throw $this->createApiException($request, $this->createResponse($e->getResponse()));
        }

        return $this->createResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function patch(Request $request)
    {
        try {
            $response = $this->client->patch(
                $request->getPath(),
                array_merge(
                    ['body' => $request->getBody()],
                    $this->getConfiguration($request)
                )
            );
        } catch (RequestException $e) {
            throw $this->createApiException($request, $this->createResponse($e->getResponse()));
        }

        return $this->createResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(Request $request)
    {
        try {
            $response = $this->client->delete(
                $request->getPath(),
                array_merge(
                    ['body' => $request->getBody()],
                    $this->getConfiguration($request)
                )
            );
        } catch (RequestException $e) {
            throw $this->createApiException($request, $this->createResponse($e->getResponse()));
        }

        return $this->createResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function head(Request $request)
    {
        try {
            $response = $this->client->head(
                $request->getPath(),
                $this->getConfiguration($request)
            );
        } catch (RequestException $e) {
            throw $this->createApiException($request, $this->createResponse($e->getResponse()));
        }

        return $this->createResponse($response);
    }

    /**
     * Retrieve the Guzzle Client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
