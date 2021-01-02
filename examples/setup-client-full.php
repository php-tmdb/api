<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Tmdb\Client;
use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\HttpClientExceptionEvent;
use Tmdb\Event\Listener\Logger\LogApiErrorListener;
use Tmdb\Event\Listener\Logger\LogHttpMessageListener;
use Tmdb\Event\Listener\Logger\LogHydrationListener;
use Tmdb\Event\Listener\Psr6CachedRequestListener;
use Tmdb\Event\Listener\Request\AcceptJsonRequestListener;
use Tmdb\Event\Listener\Request\AdultFilterRequestListener;
use Tmdb\Event\Listener\Request\ApiTokenRequestListener;
use Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener;
use Tmdb\Event\Listener\Request\LanguageFilterRequestListener;
use Tmdb\Event\Listener\Request\RegionFilterRequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\ResponseEvent;
use Tmdb\Event\TmdbExceptionEvent;
use Tmdb\Formatter\HttpMessage\SimpleHttpMessageFormatter;
use Tmdb\Formatter\Hydration\SimpleHydrationFormatter;
use Tmdb\Formatter\TmdbApiException\SimpleTmdbApiExceptionFormatter;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Token\Api\BearerToken;

$token = defined('TMDB_BEARER_TOKEN') && TMDB_BEARER_TOKEN !== 'TMDB_BEARER_TOKEN' ?
    new BearerToken(TMDB_BEARER_TOKEN) :
    new ApiToken(TMDB_API_KEY);

$ed = new Symfony\Component\EventDispatcher\EventDispatcher();

$logger = new Logger(
    'php-tmdb',
    [
        new StreamHandler(__DIR__ . '/var/log/php-tmdb.log', LogLevel::DEBUG)
    ]
);

$client = new Client(
    [
        /** @var ApiToken|BearerToken */
        'api_token' => $token,
        'secure' => true,
        'base_uri' => Client::TMDB_URI,
        'session_token' => null,
        'event_dispatcher' => [
            'adapter' => $ed
        ],
        // We make use of PSR-17 and PSR-18 auto discovery to automatically guess these, but preferably set these explicitly.
        'http' => [
            'client' => null,
            'request_factory' => null,
            'response_factory' => null,
            'stream_factory' => null,
            'uri_factory' => null,
        ],
        'hydration' => [
            'event_listener_handles_hydration' => false,
            'only_for_specified_models' => []
        ]
    ]
);

/**
 * Instantiate the PSR-6 cache
 */
$cache = new FilesystemAdapter('php-tmdb', 86400, __DIR__ . '/var/cache');

/**
 * The full setup makes use of the Psr6CachedRequestListener.
 *
 * Required event listeners and events to be registered with the PSR-14 Event Dispatcher.
 */
$requestListener = new Psr6CachedRequestListener(
    $client->getHttpClient(),
    $ed,
    $cache,
    $client->getHttpClient()->getPsr17StreamFactory(),
    []
);

$ed->addListener(RequestEvent::class, $requestListener);

$apiTokenListener = new ApiTokenRequestListener($client->getToken());
$ed->addListener(BeforeRequestEvent::class, $apiTokenListener);

$acceptJsonListener = new AcceptJsonRequestListener();
$ed->addListener(BeforeRequestEvent::class, $acceptJsonListener);

$jsonContentTypeListener = new ContentTypeJsonRequestListener();
$ed->addListener(BeforeRequestEvent::class, $jsonContentTypeListener);

/**
 * Optional for logging, you can also omit events you do not wish to be logged.
 */
$requestLoggerListener = new LogHttpMessageListener(
    $logger,
    new \Tmdb\Formatter\HttpMessage\FullHttpMessageFormatter()
);
$ed->addListener(BeforeRequestEvent::class, $requestLoggerListener);
$ed->addListener(ResponseEvent::class, $requestLoggerListener);
$ed->addListener(HttpClientExceptionEvent::class, $requestLoggerListener);

$hydrationLoggerListener = new LogHydrationListener(
    $logger,
    new SimpleHydrationFormatter(),
    false // set to true if you wish to add the json data passed for each hydration, do not use this on production
);
$ed->addListener(BeforeHydrationEvent::class, $hydrationLoggerListener);

$apiErrorListener = new LogApiErrorListener(
    $logger,
    new SimpleTmdbApiExceptionFormatter()
);
$ed->addListener(TmdbExceptionEvent::class, $apiErrorListener);

/**
 * Optional plugins.
 */
$adultFilterListener = new AdultFilterRequestListener(false);
$ed->addListener(BeforeRequestEvent::class, $adultFilterListener);

$languageFilterListener = new LanguageFilterRequestListener(TMDB_LANGUAGE);
$ed->addListener(BeforeRequestEvent::class, $languageFilterListener);

$regionFilterListener = new RegionFilterRequestListener(TMDB_REGION);
$ed->addListener(BeforeRequestEvent::class, $regionFilterListener);

return $client;
