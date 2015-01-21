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

use Doctrine\Common\Cache\FilesystemCache;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Tmdb\HttpClient\Adapter\AdapterInterface;
use Tmdb\HttpClient\Adapter\GuzzleAdapter;
use Tmdb\HttpClient\HttpClient;
use Tmdb\ApiToken as Token;

/**
 * Client wrapper for TMDB
 * @package Tmdb
 */
class Client
{
    use ApiMethodsTrait;

    /** Client Version */
    const VERSION  = '2.0-BETA';

    /** Base API URI */
    const TMDB_URI = '//api.themoviedb.org/3/';

    /** Insecure schema */
    const SCHEME_INSECURE = 'http';

    /** Secure schema */
    const SCHEME_SECURE = 'https';

    /**
     * The event dispatcher
     *
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * Stores the HTTP Client
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Stores API authentication token
     *
     * @var Token
     */
    private $token;

    /**
     * Whether the request is supposed to use a secure schema
     *
     * @var bool
     */
    private $secure = true;

    /**
     * Store the options
     *
     * @var array
     */
    private $options = [];

    /**
     * Construct our client
     *
     * @param ApiToken $token
     * @param array    $options
     */
    public function __construct(
        ApiToken $token,
        $options = []
    )
    {
        $this->setToken($token);

        $this->secure          = array_key_exists('secure', $options) ? $options['secure'] : true;
        $this->eventDispatcher = array_key_exists('event_dispatcher', $options) && $options['event_dispatcher'] instanceof EventDispatcherInterface ?
            $options['event_dispatcher']:
            new EventDispatcher()
        ;

        $this->constructHttpClient(
            array_key_exists('adapter', $options) ? $options['adapter'] : null,
            (array) $options
        );
    }

    /**
     * @param  boolean $secure
     * @return $this
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;

        $this->reconstructHttpClient();

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
        $this->setMergedOptions(['session_token' => $sessionToken]);
        $this->reconstructHttpClient();

        return $this;
    }

    /**
     * @return SessionToken
     */
    public function getSessionToken()
    {
        return $this->getHttpClient()->getSessionToken();
    }

    /**
     * Set the API token
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
     * Get the API token
     *
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param HttpClient $httpClient
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
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
     * Get the adapter
     *
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->getHttpClient()->getAdapter();
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Construct the http client
     *
     * In case you are implementing your own adapter, the base url will be passed on through the $parameters array
     * at every call in the respective get / post methods etc. of the adapter.
     *
     * @param  AdapterInterface|null $adapter
     * @param  array                 $options
     * @return void
     */
    protected function constructHttpClient(AdapterInterface $adapter = null, array $options = [])
    {
        $adapter = (null !== $adapter) ?
            $adapter:
            new GuzzleAdapter(new \GuzzleHttp\Client(['base_url' => $this->getBaseUrl()]));

        $hasHttpClient = (null !== $this->httpClient);

        $this->setMergedOptions($options);

        if ($adapter instanceof GuzzleAdapter) {
            $this->mergeDefaultOptions();
        }

        $this->httpClient = new HttpClient(
            $this->getBaseUrl(),
            $this->getOptions(),
            $adapter,
            $this->eventDispatcher
        );

        if (!$hasHttpClient) {
            $this->httpClient->registerDefaults();
        }
    }

    /**
     * Reconstruct the HTTP Client
     */
    protected function reconstructHttpClient()
    {
        if (null !== $this->getHttpClient()) {
            $this->constructHttpClient(
                $this->getHttpClient()->getAdapter(),
                (array) $this->getOptions()
            );
        }
    }

    /**
     * Set the options, merging the defaults with the client options
     *
     * @param  array $options
     * @return array
     */
    protected function setMergedOptions(array $options = null)
    {
        $this->options = array_replace_recursive(
            [
                'token'  => $this->getToken(),
                'secure' => $this->getSecure(),
                'log'    => ['enabled' => false],
                'cache'  => ['enabled' => true],
            ],
            $options
        );
    }

    protected function mergeDefaultOptions()
    {
        $handler = null;

        if ($this->options['cache']['enabled'] && !array_key_exists('storage', $this->options['cache'])) {
            $this->options['cache']['storage'] = new FilesystemCache(
                sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-tmdb-api'
            );
        }

        if ($this->options['log']['enabled']) {
            if (!array_key_exists('handler', $this->options['log'])) {
                $this->options['log']['handler'] = new StreamHandler(
                    array_key_exists('path', $this->options['log']) ?
                        $this->options['log']['path'] :
                        sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-tmdb-api.log',
                    array_key_exists('level', $this->options['log']) ?
                        $this->options['log']['level'] :
                        Logger::DEBUG
                );
            }
        }
    }
}
