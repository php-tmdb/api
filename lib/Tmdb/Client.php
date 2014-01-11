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
     * Stores API authentication token
     *
     * @var Token
     */
    private $token;

    /**
     * Stores the HTTP Client
     *
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
     * @return Api\Configuration
     */
    public function getConfigurationApi()
    {
        return new Api\Configuration($this);
    }

    /**
     * @return Api\Authentication
     */
    public function getAuthenticationApi()
    {
        return new Api\Authentication($this);
    }

    /**
     * @return Api\Account
     */
    public function getAccountApi()
    {
        return new Api\Account($this);
    }

    /**
     * @return Api\Collections
     */
    public function getCollectionsApi()
    {
        return new Api\Collections($this);
    }

    /**
     * @return Api\Movies
     */
    public function getMoviesApi()
    {
        return new Api\Movies($this);
    }

    /**
     * @return Api\Tv
     */
    public function getTvApi()
    {
        return new Api\Tv($this);
    }

    /**
     * @return Api\TvSeason
     */
    public function getTvSeasonApi()
    {
        return new Api\TvSeason($this);
    }

    /**
     * @return Api\TvEpisode
     */
    public function getTvEpisodeApi()
    {
        return new Api\TvEpisode($this);
    }

    /**
     * @return Api\People
     */
    public function getPeopleApi()
    {
        return new Api\People($this);
    }

    /**
     * @return Api\Lists
     */
    public function getListsApi()
    {
        return new Api\Lists($this);
    }

    /**
     * @return Api\Companies
     */
    public function getCompaniesApi()
    {
        return new Api\Companies($this);
    }

    /**
     * @return Api\Genres
     */
    public function getGenresApi()
    {
        return new Api\Genres($this);
    }

    /**
     * @return Api\Keywords
     */
    public function getKeywordsApi()
    {
        return new Api\Keywords($this);
    }

    /**
     * @return Api\Discover
     */
    public function getDiscoverApi()
    {
        return new Api\Discover($this);
    }

    /**
     * @return Api\Search
     */
    public function getSearchApi()
    {
        return new Api\Search($this);
    }

    /**
     * @return Api\Reviews
     */
    public function getReviewsApi()
    {
        return new Api\Reviews($this);
    }

    /**
     * @return Api\Changes
     */
    public function getChangesApi()
    {
        return new Api\Changes($this);
    }

    /**
     * @return Api\Jobs
     */
    public function getJobsApi()
    {
        return new Api\Jobs($this);
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