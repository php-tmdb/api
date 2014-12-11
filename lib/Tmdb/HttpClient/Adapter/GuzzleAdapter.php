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
use Tmdb\Common\ParameterBag;

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

    public function getConfiguration(ParameterBag $parameters)
    {
        return [
            'headers'  => (array) $parameters['headers'],
            'query'    => (array) $parameters['query']
        ];
    }

    private function getBody(Response $response)
    {
        return (string) $response->getBody();
    }

    /**
     * {@inheritDoc}
     */
    public function get($path, ParameterBag $parameterBag)
    {
        $response = $this->client->get($path, $this->getConfiguration($parameterBag));

        return $this->getBody($response);
    }

    /**
     * {@inheritDoc}
     */
    public function post($path, $body = null, ParameterBag $parameterBag)
    {
        $response = $this->client->post($path, $body, $this->getConfiguration($parameterBag));

        return $this->getBody($response);
    }

    /**
     * {@inheritDoc}
     */
    public function put($path, $body = null, ParameterBag $parameterBag)
    {
        $response =  $this->client->put($path, $body, $this->getConfiguration($parameterBag));

        return $this->getBody($response);
    }

    /**
     * {@inheritDoc}
     */
    public function patch($path, $body = null, ParameterBag $parameterBag)
    {
        $response = $this->client->patch($path, $body, $this->getConfiguration($parameterBag));

        return $this->getBody($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($path, $body = null, ParameterBag $parameterBag)
    {
        $response = $this->client->delete($path, $body, $this->getConfiguration($parameterBag));

        return $this->getBody($response);
    }

    /**
     * {@inheritDoc}
     */
    public function head($path, ParameterBag $parameterBag)
    {
        $response = $this->client->head($path, $this->getConfiguration($parameterBag));

        return $this->getBody($response);
    }

    /**
     * Register the default subscribers for Guzzle
     *
     * @todo fix
     * @param array $options
     */
    public function registerGuzzleSubscribers(array $options)
    {
        $backoffPlugin = BackoffPlugin::getExponentialBackoff(5);
        $this->addSubscriber($backoffPlugin);
    }
}
