# A PHP Wrapper for use with the [TMDB API](https://developers.themoviedb.org/4/).

[![License](https://poser.pugx.org/php-tmdb/api/license.png)](https://packagist.org/packages/php-tmdb/api)
[![License](https://img.shields.io/github/v/tag/php-tmdb/api)](https://github.com/php-tmdb/api/releases)
[![Build Status](https://img.shields.io/github/workflow/status/php-tmdb/api/Continuous%20Integration?label=phpunit)](https://github.com/php-tmdb/api/actions?query=workflow%3A%22Continuous+Integration%22)
[![Build Status](https://img.shields.io/github/workflow/status/php-tmdb/api/Coding%20Standards?label=phpcs)](https://github.com/php-tmdb/api/actions?query=workflow%3A%22Coding+Standards%22)
[![codecov](https://img.shields.io/codecov/c/github/php-tmdb/api?token=gTM9AiO5vH)](https://codecov.io/gh/php-tmdb/api)
[![PHP](https://img.shields.io/badge/php->=7.3,%20>=7.4,%20>=8.0-8892BF.svg)](https://packagist.org/packages/php-tmdb/api)
[![Total Downloads](https://poser.pugx.org/php-tmdb/api/downloads.svg)](https://packagist.org/packages/php-tmdb/api)

Tests run with minimal, normal and development dependencies.

## Buy me a coffee, or a beer :-)

<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SMLZ362KQ8K8W"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"></a>

My stomach will appreciate your donation! 

## Main features

- Array implementation of the movie database (RAW)
- Model implementation of the movie database (By making use of the repositories)
- An `ImageHelper` class to help build image urls or html <img> elements.

## Attention newcomers to php

_If  you are new to php and starting a project to learn, I'd recommend [you skip down to the installation](#install-php-tmdbapi),
and then follow [the quickstart](#new-to-psr-standards-or-composer) that's just  for you!_

I do advise you to take a broader look later on what all these PSR standards mean and do for the php community :-). 

## PSR Compliance

We try to leave as many options open to the end users of this library, as such with 4.0 changes have
been made to introduce PSR compliance where we can. You bring the dependencies you prefer that are compliant
with PSR standards, register the listeners, and we handle the rest. 

- [PSR-3: Logger Interface](https://www.php-fig.org/psr/psr-3/), [jump to section](#logging).
    - Logs TMDB API exceptions, [jump to section](#tmdbeventlistenerloggerlogapierrorlistener).
    - Logs PSR-18 client exceptions, [jump to section](#tmdbeventlistenerloggerloghttpmessagelistener).
    - Logs requests and responses, [jump to section](#tmdbeventlistenerloggerloghttpmessagelistener).
    - Logs response hydration, [jump to section](#tmdbeventlistenerloggerloghydrationlistener).
    - Logs caching behavior , [jump to section](#todo).
- [PSR-6: Caching Interface](https://www.php-fig.org/psr/psr-6/), [jump to section](#caching).
- [PSR-7: HTTP Message Interface](https://www.php-fig.org/psr/psr-7/)
    - Requests and responses will be modified via relevant event listeners.
- _[PSR-12: Extended Coding Style](https://www.php-fig.org/psr/psr-12/)._
    - Work in progress, I'll do my best to finish before `4.1` but there is a lot to review and refactor.
      It would be nice to get contributions going our way helping out with this massive task. I can imagine
      it may take several months of doing small bits here and there to achieve this.
- [PSR-14: Event Dispatcher](https://www.php-fig.org/psr/psr-7/), [jump to section](#event-dispatching).
    - Register our listeners and events, we handle the rest.   
- _[PSR-16: Simple Cache](https://www.php-fig.org/psr/psr-16/), by adapting to PSR-6_
    - Although we do not implement this at the current stage, there are plenty of adapters converting `PSR-16` implementations to `PSR-6`.
    - We might rework this at a later stage to prevent the extra dependencies that the `php-http/cache-plugin` brings along.
- [PSR-17: HTTP Factories](https://www.php-fig.org/psr/psr-17/)
    - Bring along the http factories of your choice.
- [PSR-18: HTTP Client](https://www.php-fig.org/psr/psr-18/)
    - Bring along the PSR-18 http client of your choice.

## Framework implementations

- Symfony _(maintained by php-tmdb developers)_
  - [php-tmdb/symfony](https://github.com/php-tmdb/symfony)
- Laravel _(community maintained)_
  - [php-tmdb/laravel](https://github.com/php-tmdb/laravel)

## Installation

Install [composer](https://getcomposer.org/download/).

Before we can install the api library, you need to install a set of dependencies that provide the following implementations.

## Dependencies you have to fulfill yourself

- For `PSR-7: HTTP Message Interface`, for example `nyholm/psr7`.
- For `PSR-14: Event Dispatcher`, for example `symfony/event-dispatcher`.
- For `PSR-17: HTTP Factories`, for example `nyholm/psr7`.
- For `PSR-18: HTTP Client`, for example `guzzlehttp/guzzle`.

**I urge you to implement the optional caching implementation**

When making use of caching, make sure to also include `php-http/cache-plugin` in composer, this plugin handles the logic for us, 
so we don't have to re-invent the wheel. You are however also free to choose to implement your own cache listener, or add 
the caching logic inside the http client of your choice.

```shell script
composer require php-http/cache-plugin:^1.7
```

Even though [themoviedb.org](https://www.themoviedb.org/) disabled [rate limiting](https://developers.themoviedb.org/3/getting-started/request-rate-limiting) since the end of 2019, 
I'd still recommend enabling the cache to make your application run a bit smoother. As such the `427` retry subscriber in previous versions is not present anymore.

- For `PSR-6: Caching Interface`, for example `symfony/cache`.
- For `PSR-16: Simple Cache`, with an PSR-6 adapter for example `symfony/cache`, then use [the PSR-16 to PSR-6 adapter](https://symfony.com/doc/current/components/cache/psr6_psr16_adapters.html).

Not only will this make your application more responsive, by loading from cache when we can, it also decreases the amount of requests we need to send.

_Optional dependencies_

- For `PSR-3: Logger Interface`, for example `monolog/monolog`.

## Install php-tmdb/api

If the required dependencies above are met, you are ready to install the library.

```shell script
composer require php-tmdb/api:^4
```

Include Composer's autoloader:

```php
require_once dirname(__DIR__).'/vendor/autoload.php';
```

To use the examples provided, copy the `examples/apikey.php.dist` to `examples/apikey.php` and change the settings.

### New to PSR standards or composer?

If you came here looking to start a fun project to start learning, the above might seem a little daunting.

Don't worry! The documentation here was setup with beginners in mind as well.

We also provide a bunch of examples in the `examples/` folder.

To get started;

```shell script
composer require php-tmdb/api:^4 symfony/event-dispatcher guzzlehttp/guzzle symfony/cache monolog/monolog nyholm/psr7
```

Now that we have everything we need installed, let's get started setting up to be able to use the library.

## Quick setup

Review the setup files below and go over the [examples](examples/) folder, for example 
[examples/movies/api/get.php](examples/movies/model/get.php) or [examples/movies/api/get.php](examples/movies/api/get.php) files.

## Constructing the Client

_If you have chosen different implementations than the examples suggested beforehand, obviously all the upcoming documentation won't match. Adjust accordingly to your dependencies, we will go along with the examples given earlier._

- [Minimal setup](examples/setup-client.php)
- [Minimal setup with psr-6 caching](examples/setup-client-cache-psr6.php)
- [Full setup](examples/setup-client-full.php)
    - Includes logging
    - Includes caching
    - Includes filtering by region
    - Includes filtering by language
    - Includes filtering by adult content

## General API Usage

If you're looking for a simple array entry point the API namespace is the place to be, however we recommend you use the 
[repositories and model](#model-usage)'s functionality up ahead.

```php
use Tmdb\Client;

$client = new Client();
$movie = $client->getMoviesApi()->getMovie(550);
```

If you want to provide any other query arguments.

```php
use Tmdb\Client;

$client = new Client();
$movie = $client->getMoviesApi()->getMovie(550, ['language' => 'en']);
```

For all further calls just review the [unit tests](test/Tmdb/Tests) or [examples](examples/) provided, or the API classes themselves.

## Model Usage

The library can also be used in an object oriented manner, which I reckon is the __preferred__ way of doing things.

Instead of calling upon the client, you pass the client onto one of the many repositories and do then some work on it.

```php
use Tmdb\Repository\MovieRepository;
use Tmdb\Client;

$client = new Client();
$repository = new MovieRepository($client);
$movie = $repository->load(87421);

echo $movie->getTitle();
```

__The repositories also contain the other API methods that are available through the API namespace.__

```php
use Tmdb\Repository\MovieRepository;
use Tmdb\Client;

$client = new Client();
$repository = new MovieRepository($client);
$topRated = $repository->getTopRated(['page' => 3]);
// or
$popular = $repository->getPopular();
```

For all further calls just review the [unit tests](test/Tmdb/Tests) or [examples](examples/) provided, or the model's themselves.

## Event Dispatching

We (can) dispatch the following events inside the library, which by using event listeners you could modify some behavior.

### HTTP Client exceptions
- `Tmdb\Event\HttpClientExceptionEvent`
  - Allows to still set a successful response if the error can be corrected, by calling `$event->isPropagated()` in your listener,
    this does require you to provide a PSR-7 response object and set it with `$event->setResponse($response)`.

### TMDB API exceptions 
- `Tmdb\Event\TmdbExceptionEvent`
  - Allows to still set a successful response if the error can be corrected, by calling `$event->isPropagated()` in your listener, 
    this does require you to provide a PSR-7 response object and set it with `$event->setResponse($response)`.

### Hydration

- `Tmdb\Event\BeforeHydrationEvent`, _allows modification of the response data before being hydrated._
    - This event will still be thrown regardless if the `event_listener_handles_hydration` option is set to false, this
      allows for example the logger to still produce records.
- `Tmdb\Event\AfterHydrationEvent`, _allows modification of the eventual subject returned._
  
The current implementation within the event dispatcher causes significant overhead, you might actually not want at all.

_In the future we will look into this further for improvement, for now we have bigger fish to catch._

From `4.0` moving forward by default the hydration events have been disabled.

To re-enable this functionality, we recommend only using it for models you need to modify data for;

```php
use Tmdb\Client;

$client = new Client([
    'hydration' => [
        'event_listener_handles_hydration' => true,
        'only_for_specified_models' => [
            Tmdb\Model\Movie::class
        ]
    ]
]);
```

If that configuration has been applied, also make sure the event dispatcher you use is aware of our `HydrationListener`;

```php
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\HydrationEvent;
use Tmdb\Event\Listener\HydrationListener;

$eventDispatcher = new EventDispatcher();
$hydrationListener = new HydrationListener($eventDispatcher);
$eventDispatcher->addListener(HydrationEvent::class, $hydrationListener);
```

_If you re-enable this functionality without specifying any models, all hydration will be done through the event listeners._

### Requests & Responses  
- `Tmdb\Event\BeforeRequestEvent`
  - Allows modification of the PSR-7 request data before being sent.
  - Allows early response behavior ( think of caching ), by calling `$event->isPropagated()` in your listener,
    this does require you to provide a PSR-7 response object and set it with `$event->setResponse($response)`
- `Tmdb\Event\ResponseEvent`
  - Contains the `Request` object.
  - Allows modification of the PSR-7 response before being hydrated, this does require you to provide a PSR-7
    response object and set it with `$event->setResponse($response)`
  - Allows end-user to implement their own cache, or any other actions you'd like to perform on the given response. 

## Event listeners 

We have a couple of optional event listeners that you could add to provide additional functionality.

### Caching

Instead of constructing the default `RequestListener`, construct the client with the `Psr6CachedRequestListener`.

```php
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Tmdb\Event\Listener\Psr6CachedRequestListener;
use Tmdb\Repository\MovieRepository;
use Tmdb\Client;

$client = new Client();

$cache = new FilesystemAdapter('php-tmdb', 86400, __DIR__ . '/cache');
$requestListener = new Psr6CachedRequestListener(
    $client->getHttpClient(),
    $client->getEventDispatcher(),
    $cache,
    $client->getHttpClient()->getPsr17StreamFactory(),
    []
);

$repository = new MovieRepository($client);
$popular = $repository->getPopular();
```

_The current implementation will change again in the future, it will either involve a small change in listener registration, 
or will just happen without you being aware._ We currently base this on `php-http/cache-plugin`, which pulls in extra
dependencies we don't really use. Since caching is quite a subject itself, for now we have chosen the "quick 'n dirty way".

### Logging

The logging is divided in a couple of listeners, so you can decide what you want to log, or not. All of these 
listeners have support for writing custom formatted messages. See the relevant interfaces and classes located in the 
`Tmdb\Formatter` namespace.

Instead of monolog you can pass any PSR-3 compatible logger.

#### Tmdb\Event\Listener\Logger\LogApiErrorListener

```php
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\Listener\Logger\LogApiErrorListener;
use Tmdb\Event\TmdbExceptionEvent;
use Tmdb\Formatter\TmdbApiException\SimpleTmdbApiExceptionFormatter;

$eventDispatcher = new EventDispatcher();
$apiErrorListener = new LogApiErrorListener(
    new Logger(),
    new SimpleTmdbApiExceptionFormatter()
);

$eventDispatcher->addListener(TmdbExceptionEvent::class, $apiErrorListener);
```

This will log exceptions thrown when a response has successfully been received, but the response indicated the request was not successful.

```log
[2021-01-01 13:24:14] php-tmdb.CRITICAL: Critical API exception: 7 Invalid API key: You must be granted a valid key. [] []
```

#### Tmdb\Event\Listener\Logger\LogHttpMessageListener

```php
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\HttpClientExceptionEvent;
use Tmdb\Event\Listener\Logger\LogHttpMessageListener;
use Tmdb\Event\ResponseEvent;
use Tmdb\Formatter\HttpMessage\SimpleHttpMessageFormatter;

$eventDispatcher = new EventDispatcher();
$requestLoggerListener = new LogHttpMessageListener(
    new Monolog\Logger(),
    new SimpleHttpMessageFormatter()
);

$eventDispatcher->addListener(BeforeRequestEvent::class, $requestLoggerListener);
$eventDispatcher->addListener(ResponseEvent::class, $requestLoggerListener);
$eventDispatcher->addListener(HttpClientExceptionEvent::class, $requestLoggerListener);
```

This will log outgoing requests and responses.

```log
[2021-01-01 13:11:18] php-tmdb.INFO: Sending request: GET https://api.themoviedb.org/3/company/1?include_adult=true&language=en-US&region=us 1.1 {"length":0,"has_session_token":false} []
[2021-01-01 13:11:18] php-tmdb.INFO: Received response: 200 OK 1.1 {"status_code":200,"length":223} []
```

In case of any other PSR-18 client exceptions ( connection errors for example ), these will also be written to the log.

```log
[2021-01-01 13:36:39] php-tmdb.INFO: Sending request: GET https://api.themoviedb.org/3/company/1?include_adult=true&language=en-US&region=us 1.1 {"length":0,"has_session_token":false} []
[2021-01-01 13:36:39] php-tmdb.CRITICAL: Critical http client error: 0 cURL error 7: Failed to connect to api.themoviedb.org port 443: Connection refused (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) {"request":"https://api.themoviedb.org/3/company/1?include_adult=true&language=en-US&region=us"} []
```

#### Tmdb\Event\Listener\Logger\LogHydrationListener

```php
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Event\Listener\Logger\LogHydrationListener;
use Tmdb\Formatter\Hydration\SimpleHydrationFormatter;

$eventDispatcher = new EventDispatcher();
$hydrationLoggerListener = new LogHydrationListener(
    new Monolog\Logger(),
    new SimpleHydrationFormatter(),
    false // set to true if you wish to add the json data passed for each hydration, do not use this in production!
);

$eventDispatcher->addListener(BeforeHydrationEvent::class, $hydrationLoggerListener);
```

This will log hydration of models with (optionally) their data, useful for debugging.

```log
[2021-01-01 13:11:18] php-tmdb.DEBUG: Hydrating model "Tmdb\Model\Image\LogoImage". {"data":{"file_path":"/o86DbpburjxrqAzEDhXZcyE8pDb.png"},"data_size":49} []
[2021-01-01 13:11:18] php-tmdb.DEBUG: Hydrating model "Tmdb\Model\Company". {"data":{"description":"","headquarters":"San Francisco, California","homepage":"https://www.lucasfilm.com/","id":1,"logo_path":"/o86DbpburjxrqAzEDhXZcyE8pDb.png","name":"Lucasfilm Ltd.","origin_country":"US","parent_company":null},"data_size":227} []
```

For calls with a lot of appended data, this quickly becomes a large dump in the log file, and I would advise to 
only use this when necessary. 

**Do not enable the hydration data dumping on production, it will generate massive logs**.

### Adult filter

To enable inclusion of results considered "adult", add the following listener.

```php
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Request\AdultFilterRequestListener;

$eventDispatcher = new EventDispatcher();
$adultFilterListener = new AdultFilterRequestListener(true);

$eventDispatcher->addListener(BeforeRequestEvent::class, $adultFilterListener);
```

### Language filter

To enable filtering contents on language, add the following listener.

```php
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Request\LanguageFilterRequestListener;

$eventDispatcher = new EventDispatcher();
$languageFilterListener = new LanguageFilterRequestListener('nl-NL');

$eventDispatcher->addListener(BeforeRequestEvent::class, $languageFilterListener);
```

### Region filter

To enable filtering contents on region, add the following listener.

```php
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Request\RegionFilterRequestListener;

$eventDispatcher = new EventDispatcher();
$regionFilterListener = new RegionFilterRequestListener('nl');

$eventDispatcher->addListener(BeforeRequestEvent::class, $regionFilterListener);
```

## Guest session

If you want to make use of guest sessions, you need to specify this explicitly on the client.

```php
use Tmdb\Client;
use Tmdb\Token\Session\GuestSessionToken;

$client = new Client();
$client->setGuestSessionToken(new GuestSessionToken('my_token'));

// Now you can make calls in the guest sessions namespace. 
```

## Image Helper

An `ImageHelper` class is present to take care of the images, which does require the configuration to be loaded:

```php
use Tmdb\Client;
use Tmdb\Helper\ImageHelper;
use Tmdb\Model\Image;
use Tmdb\Repository\ConfigurationRepository;

$client = new Client();
$image = new Image();
$configRepository = new ConfigurationRepository($client);
$config = $configRepository->load();

$imageHelper = new ImageHelper($config);

echo $imageHelper->getHtml($image, 'w154', 154, 80);
```


## Collection Filtering

We also provide some easy methods to filter any collection, you should note however you can always implement your own filter easily by using Closures:

```php
use Tmdb\Model\Movie;
use Tmdb\Model\Image\PosterImage;

$movie = new Movie();

foreach($movie->getImages()->filter(
        function($key, $value){
            return $value instanceof PosterImage;
        }
    ) as $image) {
        // do something with all poster images
}
```

These basic filters however are already covered in the `Images` collection object:

```php
use Tmdb\Model\Movie;

/** @var $movie Movie **/
$backdrop = $movie
    ->getImages()
    ->filterBackdrops()
;
```
_And there are more Collections which provide filters, but you will find those out along the way._

### The GenericCollection and the ResultCollection

- The `GenericCollection` holds any collection of objects (e.g. an collection of movies).
- The `ResultCollection` is an extension of the `GenericCollection`, and inherits the response parameters _(page, total_pages, total_results)_ from an result set, this can be used to create pagination.
