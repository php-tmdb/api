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

use Tmdb\Common\ParameterBag;

class GuzzleAdapter extends AbstractAdapter
{
    private $client;

    public function __construct($options)
    {
        $this->client = new \GuzzleHttp\Client($options);
    }

    public function getConfiguration(ParameterBag $parameters)
    {
        return [
            'headers'  => (array) $parameters['headers'],
            'query'    => (array) $parameters['query']
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function get($path, ParameterBag $parameters)
    {
        return $this->client->get($path, $this->getConfiguration($parameters));
    }

    /**
     * {@inheritDoc}
     */
    public function post($path, $postBody, array $parameters = array(), array $headers = array())
    {
        return $this->client->post($path, $this->getConfiguration($parameters));
    }

    /**
     * Register the default subscribers for Guzzle
     *
     * @param array $options
     */
    public function registerGuzzleSubscribers(array $options)
    {
        $backoffPlugin = BackoffPlugin::getExponentialBackoff(5);
        $this->addSubscriber($backoffPlugin);
    }
}
