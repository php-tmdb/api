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
 * @version 4.0.0
 */

namespace Tmdb;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Token\Api\BearerToken;
use Tmdb\Token\Session\GuestSessionToken;
use Tmdb\Token\Session\SessionBearerToken;
use Tmdb\Token\Session\SessionToken;

/**
 * Client wrapper for TMDB
 * @package Tmdb
 */
class Client
{
    use ApiMethodsTrait;

    /** Client Version */
    public const VERSION = '4.0.0';

    /** Base API URI */
    public const TMDB_URI = 'api.themoviedb.org/3';

    /** Insecure schema */
    public const SCHEME_INSECURE = 'http';

    /** Secure schema */
    public const SCHEME_SECURE = 'https';

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

    private static function debugType($value): string
    {
        return is_object($value) ? get_class($value) : gettype($value);
    }

    /**
     * Construct our client
     *
     * @param ConfigurationInterface|array $options
     */
    public function __construct($options = [])
    {
        if ($options instanceof ConfigurationInterface) {
            $options = $options->all();
        }

        $this->configureOptions($options);
    }

    /**
     * Configure options
     *
     * @param array $options
     * @return array
     */
    protected function configureOptions(array $options)
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults(
            [
                'secure' => true,
                'host' => self::TMDB_URI,
                'base_uri' => null,
                'api_token' => null,
                'guest_session_token' => null,
                'http' => [
                    'client' => null,
                    'request_factory' => null,
                    'response_factory' => null,
                    'stream_factory' => null,
                    'uri_factory' => null,
                ],
                'hydration' => [
                    'event_listener_handles_hydration' => false,
                    'only_for_specified_models' => [],
                ],
                'event_dispatcher' => [
                    'adapter' => new class implements EventDispatcherInterface {
                        public function dispatch(object $event)
                        {
                            return $event;
                        }
                    },
                ],
            ]
        );

        $resolver->setRequired(
            [
                'host',
                'api_token',
                'secure',
                'http',
                'event_dispatcher',
            ]
        );

        $resolver->setAllowedTypes('host', ['string']);

        // @todo 4.1 fix smelly stuff
        $resolver->setAllowedTypes('api_token', [ApiToken::class, BearerToken::class]);
        $resolver->setAllowedTypes('secure', ['bool']);
        $resolver->setAllowedTypes('http', ['array']);
        $resolver->setAllowedTypes('event_dispatcher', ['array']);
        $resolver->setAllowedTypes('hydration', ['array']);

        $resolver->setNormalizer('http', function (Options $options, $value) {
            if (!is_array($value)) {
                throw new InvalidOptionsException(sprintf('The option "http" is expected to be of type "array", but is of type "%s".', self::debugType($value)));
            }

            $allowedKeys = ['client', 'request_factory', 'response_factory', 'stream_factory', 'uri_factory'];
            $unknownKeys = array_diff(array_keys($value), $allowedKeys);
            if (!empty($unknownKeys)) {
                throw new InvalidOptionsException(sprintf('The option "http" has unknown keys: %s.', implode(', ', $unknownKeys)));
            }

            foreach ($allowedKeys as $key) {
                if (!array_key_exists($key, $value)) {
                    throw new InvalidOptionsException(sprintf('The option "http" must define the key "%s".', $key));
                }
            }

            if ($value['client'] !== null && !$value['client'] instanceof ClientInterface) {
                throw new InvalidOptionsException(sprintf('The option "http[client]" is expected to be an instance of %s or null, but got %s.', ClientInterface::class, self::debugType($value['client'])));
            }
            if ($value['request_factory'] !== null && !$value['request_factory'] instanceof RequestFactoryInterface) {
                throw new InvalidOptionsException(sprintf('The option "http[request_factory]" is expected to be an instance of %s or null, but got %s.', RequestFactoryInterface::class, self::debugType($value['request_factory'])));
            }
            if ($value['response_factory'] !== null && !$value['response_factory'] instanceof ResponseFactoryInterface) {
                throw new InvalidOptionsException(sprintf('The option "http[response_factory]" is expected to be an instance of %s or null, but got %s.', ResponseFactoryInterface::class, self::debugType($value['response_factory'])));
            }
            if ($value['stream_factory'] !== null && !$value['stream_factory'] instanceof StreamFactoryInterface) {
                throw new InvalidOptionsException(sprintf('The option "http[stream_factory]" is expected to be an instance of %s or null, but got %s.', StreamFactoryInterface::class, self::debugType($value['stream_factory'])));
            }
            if ($value['uri_factory'] !== null && !$value['uri_factory'] instanceof UriFactoryInterface) {
                throw new InvalidOptionsException(sprintf('The option "http[uri_factory]" is expected to be an instance of %s or null, but got %s.', UriFactoryInterface::class, self::debugType($value['uri_factory'])));
            }

            return $value;
        });

        $resolver->setNormalizer('hydration', function (Options $options, $value) {
            if (!is_array($value)) {
                throw new InvalidOptionsException(sprintf('The option "hydration" is expected to be of type "array", but is of type "%s".', self::debugType($value)));
            }

            $allowedKeys = ['event_listener_handles_hydration', 'only_for_specified_models'];
            $unknownKeys = array_diff(array_keys($value), $allowedKeys);
            if (!empty($unknownKeys)) {
                throw new InvalidOptionsException(sprintf('The option "hydration" has unknown keys: %s.', implode(', ', $unknownKeys)));
            }

            if (!array_key_exists('event_listener_handles_hydration', $value) || !is_bool($value['event_listener_handles_hydration'])) {
                throw new InvalidOptionsException('The option "hydration[event_listener_handles_hydration]" is expected to be of type "bool".');
            }
            if (!array_key_exists('only_for_specified_models', $value) || !is_array($value['only_for_specified_models'])) {
                throw new InvalidOptionsException('The option "hydration[only_for_specified_models]" is expected to be of type "array".');
            }

            return $value;
        });

        $resolver->setNormalizer('event_dispatcher', function (Options $options, $value) {
            if (!is_array($value)) {
                throw new InvalidOptionsException(sprintf('The option "event_dispatcher" is expected to be of type "array", but is of type "%s".', self::debugType($value)));
            }

            $allowedKeys = ['adapter'];
            $unknownKeys = array_diff(array_keys($value), $allowedKeys);
            if (!empty($unknownKeys)) {
                throw new InvalidOptionsException(sprintf('The option "event_dispatcher" has unknown keys: %s.', implode(', ', $unknownKeys)));
            }

            if (!array_key_exists('adapter', $value) || !$value['adapter'] instanceof EventDispatcherInterface) {
                throw new InvalidOptionsException(sprintf('The option "event_dispatcher[adapter]" is expected to be an instance of %s.', EventDispatcherInterface::class));
            }

            return $value;
        });

        // @todo 4.1 fix smelly stuff
        $resolver->setAllowedTypes(
            'guest_session_token',
            [
                GuestSessionToken::class,
                SessionBearerToken::class,
                'null'
            ]
        );

        if (is_string($options['api_token'])) {
            $options['api_token'] = new ApiToken($options['api_token']);
        }

        $this->options = $this->postResolve(
            $resolver->resolve($options)
        );

        $this->httpClient = new HttpClient(
            [
                'http' => $this->options['http'],
                'event_dispatcher' => $this->options['event_dispatcher'],
                'base_uri' => $this->options['base_uri'],
                'hydration' => $this->options['hydration']
            ]
        );

        return $this->options;
    }

    /**
     * Post resolve
     *
     * @param array $options
     * @return array
     */
    protected function postResolve(array $options = []): array
    {
        $options['http']['client'] = $options['http']['client'] ??
            Psr18ClientDiscovery::find();
        $options['http']['request_factory'] = $options['http']['request_factory'] ??
            Psr17FactoryDiscovery::findRequestFactory();
        $options['http']['response_factory'] = $options['http']['response_factory'] ??
            Psr17FactoryDiscovery::findResponseFactory();
        $options['http']['stream_factory'] = $options['http']['stream_factory'] ??
            Psr17FactoryDiscovery::findStreamFactory();
        $options['http']['uri_factory'] = $options['http']['uri_factory'] ??
            Psr17FactoryDiscovery::findUriFactory();

        // Automatically enable event listener acceptance if the end-user forgot to enable this.
        if (
            !empty($options['hydration']['only_for_specified_models']) &&
            !$options['hydration']['event_listener_handles_hydration']
        ) {
            $options['hydration']['event_listener_handles_hydration'] = true;
        }

        $options['base_uri'] = sprintf(
            '%s://%s',
            $options['secure'] ? self::SCHEME_SECURE : self::SCHEME_INSECURE,
            $options['host']
        );

        return $options;
    }

    /**
     * Get the event dispatcher
     *
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->options['event_dispatcher']['adapter'];
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return GuestSessionToken|null
     */
    public function getGuestSessionToken(): ?GuestSessionToken
    {
        return $this->options['guest_session_token'];
    }

    /**
     * @param GuestSessionToken|null $guestSessionToken
     * @return self
     */
    public function setGuestSessionToken(?GuestSessionToken $guestSessionToken): Client
    {
        $this->options['guest_session_token'] = $guestSessionToken;

        return $this;
    }

    /**
     * @return ApiToken|BearerToken
     */
    public function getToken(): ApiToken
    {
        return $this->options['api_token'];
    }

    /**
     * @param string $key
     *
     * @return array|mixed
     */
    public function getOption(string $key)
    {
        return array_key_exists($key, $this->options) ? $this->options[$key] : null;
    }
}
