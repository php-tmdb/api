<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;
use Tmdb\Client;
use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\HttpClientExceptionEvent;
use Tmdb\Event\Listener\Logger\LogApiErrorListener;
use Tmdb\Event\Listener\Logger\LogHttpMessageListener;
use Tmdb\Event\Listener\Logger\LogHydrationListener;
use Tmdb\Event\Listener\Request\AcceptJsonRequestListener;
use Tmdb\Event\Listener\Request\AdultFilterRequestListener;
use Tmdb\Event\Listener\Request\ApiTokenRequestListener;
use Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener;
use Tmdb\Event\Listener\Request\LanguageFilterRequestListener;
use Tmdb\Event\Listener\Request\RegionFilterRequestListener;
use Tmdb\Event\Listener\RequestListener;
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

// Required
$requestListener = new RequestListener($client->getHttpClient(), $ed);
$apiTokenListener = new ApiTokenRequestListener($client->getToken());
$adultFilterListener = new AdultFilterRequestListener(true);
$languageFilterListener = new LanguageFilterRequestListener(TMDB_LANGUAGE);
$regionFilterListener = new RegionFilterRequestListener(TMDB_REGION);
$acceptJsonListener = new AcceptJsonRequestListener();
$jsonContentTypeListener = new ContentTypeJsonRequestListener();

$ed->addListener(BeforeRequestEvent::class, $apiTokenListener);
$ed->addListener(BeforeRequestEvent::class, $acceptJsonListener);
$ed->addListener(BeforeRequestEvent::class, $jsonContentTypeListener);
$ed->addListener(BeforeRequestEvent::class, $adultFilterListener);
$ed->addListener(BeforeRequestEvent::class, $languageFilterListener);
$ed->addListener(BeforeRequestEvent::class, $regionFilterListener);

return $client;
