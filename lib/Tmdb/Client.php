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
use Psr\Log\LogLevel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
    const VERSION  = '2.0.9';

    /** Base API URI */
    const TMDB_URI = 'api.themoviedb.org/3/';

    /** Insecure schema */
    const SCHEME_INSECURE = 'http';

    /** Secure schema */
    const SCHEME_SECURE = 'https';

    /**
     * Stores the HTTP Client
     *
     * @var HttpClient
     */
    private $httpClient;

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
    public function __construct(ApiToken $token, $options = [])
    {
        if ($options instanceof ConfigurationInterface) {
            $options = $options->all();
        }

        $this->configureOptions(array_replace(['token' => $token], (array) $options));
        $this->constructHttpClient();
    }

    /**
     * @param  SessionToken $sessionToken
     * @return $this
     */
    public function setSessionToken($sessionToken)
    {
        $this->options['session_token'] = $sessionToken;
        $this->reconstructHttpClient();

        return $this;
    }

    /**
     * @return SessionToken
     */
    public function getSessionToken()
    {
        return $this->options['session_token'];
    }

    /**
     * Get the API token
     *
     * @return Token
     */
    public function getToken()
    {
        return $this->options['token'];
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
     * Get the adapter
     *
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->options['adapter'];
    }

    /**
     * Get the event dispatcher
     *
     * @return AdapterInterface
     */
    public function getEventDispatcher()
    {
        return $this->options['event_dispatcher'];
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $key
     *
     * @return array
     */
    public function getOption($key)
    {
        return array_key_exists($key, $this->options) ? $this->options : null;
    }

    /**
     * @param array $options
     *
     * @return array
     */
    public function setOptions(array $options = [])
    {
        $this->options = $this->configureOptions($options);
    }

    /**
     * Construct the http client
     *
     * In case you are implementing your own adapter, the base url will be passed on through the $parameters array
     * at every call in the respective get / post methods etc. of the adapter.
     *
     * @return void
     */
    protected function constructHttpClient()
    {
        $hasHttpClient = (null !== $this->httpClient);

        $this->httpClient = new HttpClient($this->getOptions());

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
            $this->constructHttpClient();
        }
    }

    /**
     * Configure options
     *
     * @param  array $options
     * @return array
     */
    protected function configureOptions(array $options)
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'adapter'          => null,
            'secure'           => true,
            'host'             => self::TMDB_URI,
            'base_url'         => null,
            'token'            => null,
            'session_token'    => null,
            'event_dispatcher' => array_key_exists('event_dispatcher', $this->options) ? $this->options['event_dispatcher'] : new EventDispatcher(),
            'cache'            => [],
            'log'              => [],
        ]);

        $resolver->setRequired([
            'adapter',
            'host',
            'token',
            'secure',
            'event_dispatcher',
            'cache',
            'log'
        ]);

        $resolver->setAllowedTypes('adapter', ['object', 'null']);
        $resolver->setAllowedTypes('host', ['string']);
        $resolver->setAllowedTypes('secure', ['bool']);
        $resolver->setAllowedTypes('token', ['object']);
        $resolver->setAllowedTypes('session_token', ['object', 'null']);
        $resolver->setAllowedTypes('event_dispatcher', ['object']);

        $this->options = $resolver->resolve($options);

        $this->postResolve($options);

        return $this->options;
    }

    /**
     * Configure caching
     *
     * @param  array $options
     * @return array
     */
    protected function configureCacheOptions(array $options = [])
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'enabled'    => true,
            'handler'    => null,
            'subscriber' => null,
            'path'       => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-tmdb-api',
        ]);

        $resolver->setRequired([
            'enabled',
            'handler',
        ]);

        $resolver->setAllowedTypes('enabled', ['bool']);
        $resolver->setAllowedTypes('handler', ['object', 'null']);
        $resolver->setAllowedTypes('subscriber', ['object', 'null']);
        $resolver->setAllowedTypes('path', ['string', 'null']);

        $options = $resolver->resolve(array_key_exists('cache', $options) ? $options['cache'] : []);

        if ($options['enabled'] && !$options['handler']) {
            $options['handler'] = new FilesystemCache(
                $options['path']
            );
        }

        return $options;
    }

    /**
     * Configure logging
     *
     * @param  array $options
     * @return array
     */
    protected function configureLogOptions(array $options = [])
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'enabled'    => false,
            'level'      => LogLevel::DEBUG,
            'handler'    => null,
            'subscriber' => null,
            'path'       => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-tmdb-api.log',
        ]);

        $resolver->setRequired([
            'enabled',
            'level',
            'handler',
        ]);

        $resolver->setAllowedTypes('enabled', ['bool']);
        $resolver->setAllowedTypes('level', ['string']);
        $resolver->setAllowedTypes('handler', ['object', 'null']);
        $resolver->setAllowedTypes('path', ['string', 'null']);
        $resolver->setAllowedTypes('subscriber', ['object', 'null']);

        $options = $resolver->resolve(array_key_exists('log', $options) ? $options['log'] : []);

        if ($options['enabled'] && !$options['handler']) {
            $options['handler'] = new StreamHandler(
                $options['path'],
                $options['level']
            );
        }

        return $options;
    }

    /**
     * Post resolve
     *
     * @param array $options
     */
    protected function postResolve(array $options = [])
    {
        $this->options['base_url'] = sprintf(
            '%s://%s',
            $this->options['secure'] ? self::SCHEME_SECURE : self::SCHEME_INSECURE,
            $this->options['host']
        );

        if (!$this->options['adapter']) {
            $this->options['adapter'] = new GuzzleAdapter(
                new \GuzzleHttp\Client(['base_url' => $this->options['base_url']])
            );
        }

        $this->options['cache'] = $this->configureCacheOptions($options);
        $this->options['log']   = $this->configureLogOptions($options);
    }
}
