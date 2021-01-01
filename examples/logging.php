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

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;
use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\HttpClientExceptionEvent;
use Tmdb\Event\Listener\Logger\LogApiErrorListener;
use Tmdb\Event\Listener\Logger\LogHttpMessageListener;
use Tmdb\Event\Listener\Logger\LogHydrationListener;
use Tmdb\Event\ResponseEvent;
use Tmdb\Event\TmdbExceptionEvent;
use Tmdb\Formatter\HttpMessage\SimpleHttpMessageFormatter;
use Tmdb\Formatter\Hydration\SimpleHydrationFormatter;
use Tmdb\Formatter\TmdbApiException\SimpleTmdbApiExceptionFormatter;
use Tmdb\Repository\MovieRepository;

require_once '../vendor/autoload.php';
require_once 'apikey.php';

/** @var Tmdb\Client $client * */
$client = require_once('setup-client.php');
$ed = $client->getEventDispatcher();

$logger = new Logger(
    'php-tmdb',
    [
        new StreamHandler(__DIR__ . '/php-tmdb.log', LogLevel::DEBUG)
    ]
);

// Optional for logging, you can also omit events you do not wish to be logged.
$requestLoggerListener = new LogHttpMessageListener(
    $logger,
    new SimpleHttpMessageFormatter()
);
$hydrationLoggerListener = new LogHydrationListener(
    $logger,
    new SimpleHydrationFormatter(),
    true // set to true if you wish to add the json data passed for each hydration, do not use this on production
);
$apiErrorListener = new LogApiErrorListener(
    $logger,
    new SimpleTmdbApiExceptionFormatter()
);

$ed->addListener(BeforeRequestEvent::class, $requestLoggerListener);
$ed->addListener(ResponseEvent::class, $requestLoggerListener);
$ed->addListener(HttpClientExceptionEvent::class, $requestLoggerListener);

$ed->addListener(TmdbExceptionEvent::class, $apiErrorListener);
$ed->addListener(BeforeHydrationEvent::class, $hydrationLoggerListener);

$repository = new MovieRepository($client);
$movie = $repository->load(19995);
