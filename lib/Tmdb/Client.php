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

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Tmdb\HttpClient\Adapter\AdapterInterface;
use Tmdb\HttpClient\Adapter\GuzzleAdapter;
use Tmdb\HttpClient\HttpClient;
use Tmdb\HttpClient\HttpClientInterface;
use Tmdb\ApiToken as Token;

/**
 * Client wrapper for TMDB
 * @package Tmdb
 */
class Client
{
    /**
     * Base API URI
     */
    const TMDB_URI = '//api.themoviedb.org/3/';

    /**
     * Insecure schema
     */
    const SCHEME_INSECURE = 'http';

    /**
     * Secure schema
     */
    const SCHEME_SECURE = 'https';

    private $eventDispatcher;

    /**
     * Stores API authentication token
     *
     * @var Token
     */
    private $token;

    /**
     * Stores API user session token
     *
     * @var SessionToken
     */
    private $sessionToken;

    /**
     * Whether the request is supposed to use a secure schema
     *
     * @var bool
     */
    private $secure = false;

    /**
     * Stores the HTTP Client
     *
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Holds the log path
     *
     * @var string
     */
    private $logPath;

    /**
     * Enable logging?
     *
     * @var bool
     */
    private $logEnabled = false;

    /**
     * Stores the cache path
     *
     * @var string
     */
    private $cachePath;

    /**
     * Stores whether the cache is enabled or not
     *
     * @var boolean
     */
    private $cacheEnabled = false;

    /**
     * Construct our client
     *
     * @param object   $adapter
     * @param ApiToken $token
     * @param boolean  $secure
     * @param array    $options
     */
    public function __construct(
        ApiToken $token,
        $adapter = null,
        $secure = false,
        $options = []
    )
    {
        $this->eventDispatcher = array_key_exists('event_dispatcher', $options) && $options['event_dispatcher'] instanceof EventDispatcherInterface ?
            $options['event_dispatcher']:
            new EventDispatcher()
        ;

        $this->setToken($token);
        $this->setSecure($secure);
        $this->constructHttpClient(
            $adapter,
            array_merge(
                [
                    'token'  => $this->getToken(),
                    'secure' => $this->getSecure()
                ],
                $options
            )
        );
    }

    /**
     * Construct the http client
     *
     * @param  object|null $adapter
     * @param  array       $options
     * @return void
     */
    private function constructHttpClient($adapter = null, array $options)
    {
        $this->httpClient  = new HttpClient(
            $this->getBaseUrl(),
            $options,
            null !== $adapter ? $adapter : new GuzzleAdapter(['base_url' => $this->getBaseUrl()]),
            $this->eventDispatcher
        );
    }

    /**
     * Add the token subscriber
     *
     * @return Token
     */
    public function getToken()
    {
        return $this->token !== null ? $this->token : null;
    }

    /**
     * Add the token subscriber
     *
     * @param  Token $token
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
     * @return Api\Find
     */
    public function getFindApi()
    {
        return new Api\Find($this);
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
     * @return Api\Networks
     */
    public function getNetworksApi()
    {
        return new Api\Networks($this);
    }

    /**
     * @return Api\Credits
     */
    public function getCreditsApi()
    {
        return new Api\Credits($this);
    }

    /**
     * @return Api\Certifications
     */
    public function getCertificationsApi()
    {
        return new Api\Certifications($this);
    }

    /**
     * @return Api\Timezones
     */
    public function getTimezonesApi()
    {
        return new Api\Timezones($this);
    }

    /**
     * @return Api\GuestSession
     */
    public function getGuestSessionApi()
    {
        return new Api\GuestSession($this);
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param HttpClient $httpClient
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Return the base url with preferred schema
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return sprintf(
            '%s:%s',
            $this->getSecure() ? self::SCHEME_SECURE : self::SCHEME_INSECURE,
            self::TMDB_URI
        );
    }

    /**
     * @param  boolean $secure
     * @return $this
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;

        if ($this->httpClient instanceof HttpClientInterface) {
            $this->getHttpClient()->setBaseUrl($this->getBaseUrl());
        }

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * @param  SessionToken $sessionToken
     * @return $this
     */
    public function setSessionToken($sessionToken)
    {
        $this->sessionToken = $sessionToken;

        if ($this->httpClient instanceof HttpClientInterface) {
            $this->getHttpClient()->setSessionToken($sessionToken);
        }

        return $this;
    }

    /**
     * @return SessionToken
     */
    public function getSessionToken()
    {
        return $this->sessionToken;
    }

    /**
     * @return boolean
     */
    public function getCacheEnabled()
    {
        return $this->cacheEnabled;
    }

    /**
     * Set cache path
     *
     * Leaving the second argument out will use sys_get_temp_dir()
     *
     * @param  boolean $enabled
     * @param  string  $path
     * @return $this
     */
    public function setCaching($enabled = true, $path = null)
    {
        $this->cacheEnabled = $enabled;
        $this->cachePath    = (null === $path) ?
            sys_get_temp_dir() . '/php-tmdb-api' :
            $path
        ;

        $this->getHttpClient()->setCaching([
            'enabled'    => $enabled,
            'cache_path' => $path
        ]);

        return $this;
    }

    /**
     * @return string
     */
    public function getCachePath()
    {
        return $this->cachePath;
    }

    /**
     * @param  \Psr\Log\LoggerInterface $logger
     * @return $this
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @return boolean
     */
    public function getLogEnabled()
    {
        return $this->logEnabled;
    }

    /**
     * Set log path
     *
     * Leaving the second argument out will use sys_get_temp_dir()
     *
     * @param  boolean $enabled
     * @param  string  $path
     * @return $this
     */
    public function setLogging($enabled = true, $path = null)
    {
        $this->logEnabled = $enabled;
        $this->logPath    = (null === $path) ?
            sys_get_temp_dir() . '/php-tmdb-api.log' :
            $path
        ;

        $this->getHttpClient()->setLogging([
            'enabled'  => $enabled,
            'log_path' => $path
        ]);

        return $this;
    }

    /**
     * @return string
     */
    public function getLogPath()
    {
        return $this->logPath;
    }

    /**
     * Get the adapter
     *
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->getHttpClient()->getAdapter();
    }
}
