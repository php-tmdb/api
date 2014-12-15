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
use GuzzleHttp\Message\Response;
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

    public function getConfiguration(Request $request)
    {
        return [
            'headers'  => (array) $request->getHeaders(),
            'query'    => (array) $request->getParameters()
        ];
    }

    private function getBody(Response $response)
    {
        return (string) $response->getBody();
    }

    /**
     * {@inheritDoc}
     */
    public function get(Request $request)
    {
        $response = $this->client->get(
            $request->getPath(),
            $this->getConfiguration($request)
        );

        return $this->getBody($response);
    }

    /**
     * {@inheritDoc}
     */
    public function post(Request $request)
    {
        $response = $this->client->post(
            $request->getPath(),
            array_merge(
                ['body' => $request->getBody()],
                $this->getConfiguration($request)
            )
        );

        return $this->getBody($response);
    }

    /**
     * {@inheritDoc}
     */
    public function put(Request $request)
    {
        $response = $this->client->put(
            $request->getPath(),
            array_merge(
                ['body' => $request->getBody()],
                $this->getConfiguration($request)
            )
        );

        return $this->getBody($response);
    }

    /**
     * {@inheritDoc}
     */
    public function patch(Request $request)
    {
        $response = $this->client->patch(
            $request->getPath(),
            array_merge(
                ['body' => $request->getBody()],
                $this->getConfiguration($request)
            )
        );

        return $this->getBody($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(Request $request)
    {
        $response = $this->client->delete(
            $request->getPath(),
            array_merge(
                ['body' => $request->getBody()],
                $this->getConfiguration($request)
            )
        );

        return $this->getBody($response);
    }

    /**
     * {@inheritDoc}
     */
    public function head(Request $request)
    {
        $response = $this->client->head(
            $request->getPath(),
            $this->getConfiguration($request)
        );

        return $this->getBody($response);
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
