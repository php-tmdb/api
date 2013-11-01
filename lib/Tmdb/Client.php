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
namespace Tmdb;

use Guzzle\Http\Client as GuzzleClient;
use Guzzle\Http\ClientInterface;
use Guzzle\Http\Message\RequestInterface;

use Tmdb\Exception\InvalidArgumentException;
use Tmdb\HttpClient\HttpClient;
use Tmdb\HttpClient\HttpClientInterface;

use Tmdb\ApiToken as Token;
use Tmdb\HttpClient\Plugin\AcceptJsonHeader;
use Tmdb\HttpClient\Plugin\ApiTokenPlugin;

/**
 * Simple wrapper for the Tmdb API
 *
 * @package Tmdb
 */
class Client {
    const TMDB_URI = 'http://private-a868-themoviedb.apiary.io/3/';

    /**
     * @var Token
     */
    private $token;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    private $options = array();

    /**
     * Construct our client
     *
     * @param ClientInterface $httpClient
     * @param Token $token
     */
    public function __construct(Token $token, ClientInterface $httpClient = null)
    {
        $httpClient = $httpClient ?: new GuzzleClient(self::TMDB_URI);

        $plugin = new ApiTokenPlugin($token);
        $httpClient->addSubscriber($plugin);

        $plugin = new AcceptJsonHeader();
        $httpClient->addSubscriber($plugin);

        $this->httpClient = new HttpClient(self::TMDB_URI, array(), $httpClient);
        $this->setToken($token);
    }

    /**
     * Add the token subscriber
     *
     * @param Token $token
     * @return $this
     */
    public function setToken(Token $token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param $name
     * @throws Exception\InvalidArgumentException
     */
    public function api($name)
    {
        switch($name) {
            case 'movies':
                /** @return Api\Movies */
                $api = new Api\Movies($this);
                break;

            default:
                throw new InvalidArgumentException();
        }

        return $api;
    }

    /**
     * @return HttpClientInterface
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param HttpClientInterface $httpClient
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Clears used headers
     */
    public function clearHeaders()
    {
        $this->httpClient->clearHeaders();
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->httpClient->setHeaders($headers);
    }

    /**
     * @param string $name
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function getOption($name)
    {
        if (!array_key_exists($name, $this->options)) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $name));
        }

        return $this->options[$name];
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @throws InvalidArgumentException
     * @throws InvalidArgumentException
     */
    public function setOption($name, $value)
    {
        if (!array_key_exists($name, $this->options)) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $name));
        }

        $this->options[$name] = $value;
    }
}