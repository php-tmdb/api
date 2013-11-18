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

use Tmdb\Api\ApiInterface;
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
    const TMDB_URI = 'http://api.themoviedb.org/3/';

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

        if ($httpClient instanceof \Guzzle\Common\HasDispatcherInterface) {
            $apiQueryTokenPlugin = new ApiTokenPlugin($token);
            $httpClient->addSubscriber($apiQueryTokenPlugin);

            $acceptJsonHeaderPlugin = new AcceptJsonHeader();
            $httpClient->addSubscriber($acceptJsonHeaderPlugin);
        }

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
     * @return Api\Movies
     */
    public function getMovieApi()
    {
        return new Api\Movies($this);
    }

    /**
     * Return the relevant API object
     *
     * @todo we should either register these by DI, or hardcode the return values through the constructor, and provide getApiConfiguration() type of methods
     *
     * @param $name
     * @throws Exception\InvalidArgumentException
     * @return ApiInterface
     */
    public function api($name)
    {
        switch($name) {
            case 'configuration':
                /** @var Api\Configuration */
                $api = new Api\Configuration($this);
                break;

            case 'authentication':
                /** @var Api\Authentication */
                $api = new Api\Authentication($this);
                break;

            case 'account':
                /** @var Api\Account */
                $api = new Api\Account($this);
                break;

            case 'movies':
                /** @var Api\Movies */
                $api = new Api\Movies($this);
                break;

            case 'collections':
                /** @return Api\Collections */
                $api = new Api\Collections($this);
                break;

            case 'tv':
                /** @return Api\Tv */
                $api = new Api\Tv($this);
                break;

            case 'tvseason':
                /** @return Api\TvSeason */
                $api = new Api\TvSeason($this);
                break;

            case 'tvepisode':
                /** @return Api\TvEpisode */
                $api = new Api\TvEpisode($this);
                break;

            case 'people':
                /** @return Api\People */
                $api = new Api\People($this);
                break;

            case 'lists':
                /** @return Api\Lists */
                $api = new Api\Lists($this);
                break;

            case 'companies':
                /** @return Api\Companies */
                $api = new Api\Companies($this);
                break;

            case 'genres':
                /** @return Api\Genres */
                $api = new Api\Genres($this);
                break;

            case 'keywords':
                /** @return Api\Keywords */
                $api = new Api\Keywords($this);
                break;

            case 'discover':
                /** @return Api\Discover */
                $api = new Api\Discover($this);
                break;

            case 'search':
                /** @return Api\Search */
                $api = new Api\Search($this);
                break;

            case 'reviews':
                /** @return Api\Reviews */
                $api = new Api\Reviews($this);
                break;

            case 'changes':
                /** @return Api\Changes */
                $api = new Api\Changes($this);
                break;

            case 'jobs':
                /** @return Api\Jobs */
                $api = new Api\Jobs($this);
                break;

            default:
                throw new InvalidArgumentException(sprintf('The API type "%s" is not supported.', $name));
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