# A PHP Wrapper for use with the [TMDB API](http://docs.themoviedb.apiary.io/).

[![License](https://poser.pugx.org/php-tmdb/api/license.png)](https://packagist.org/packages/php-tmdb/api)
[![License](https://img.shields.io/github/v/tag/php-tmdb/api)](https://github.com/php-tmdb/api/releases)
[![Build Status](https://img.shields.io/github/workflow/status/php-tmdb/api/Continuous%20Integration?label=phpunit)](https://travis-ci.org/php-tmdb/api)
[![Build Status](https://img.shields.io/github/workflow/status/php-tmdb/api/Coding%20Standards?label=phpcs)](https://travis-ci.org/php-tmdb/api)
[![codecov](https://img.shields.io/codecov/c/github/php-tmdb/api?token=gTM9AiO5vH)](https://codecov.io/gh/php-tmdb/api)
[![PHP & HHVM](https://img.shields.io/badge/php->=7.3,%20>=8.0-8892BF.svg)](http://hhvm.h4cc.de/package/php-tmdb/api)
[![Total Downloads](https://poser.pugx.org/php-tmdb/api/downloads.svg)](https://packagist.org/packages/php-tmdb/api)

Tests run with minimal, normal and development dependencies.

## Main features

- Array implementation of the movie database (RAW)
- Model implementation of the movie database (By making use of the repositories)
- An `ImageHelper` class to help build image urls or html <img> elements.

## PSR Compliance

We try to leave as many options open to the end users of this library, as such for 4.0 a major
break has been made to introduce PSR compliance where we can.

- [PSR-3: Logger Interface](https://www.php-fig.org/psr/psr-3/)
    - Access to the logger of your choice through the container in the client.
    - Logs requests and responses
    - Logs caching behavior
- [PSR-6: Caching Interface](https://www.php-fig.org/psr/psr-6/)
    - Access to the cache of your choice through the container in the client.
- [PSR-7: HTTP Message Interface](https://www.php-fig.org/psr/psr-7/)
    - Requests and responses are modify by their interfaces via events.
- [PSR-11: Container Interface](https://www.php-fig.org/psr/psr-11/)
    - Allows easier implementation by being able to access pre-built services.
- _[PSR-12: Extended Coding Style](https://www.php-fig.org/psr/psr-12/)._
    - Work in progress, I'll do my best to finish before `4.1` but there is a lot to review and refactor.
      It would be nice to get contributions going our way helping out with this massive task.
- [PSR-14: Event Dispatcher](https://www.php-fig.org/psr/psr-7/)
    - Access to the event dispatcher of your choice through the container in the client.
    - Register our listeners and events, we handle the rest.
    
    @todo link to anchor below when implementation is solid
    
- [PSR-16: Simple Cache](https://www.php-fig.org/psr/psr-16/)
    - @todo
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

Before we can install the api library, you need to install a dependency that provides this implementation.

- For `PSR-7: HTTP Message Interface`, for example `nyholm/psr7`.
- For `PSR-11: Container Interface`, for example `symfony/dependency-injection`.
- For `PSR-14: Event Dispatcher`, for example `symfony/event-dispatcher`.
- For `PSR-17: HTTP Factories`, for example `nyholm/psr7`.
- For `PSR-18: HTTP Client`, for example `php-http/guzzle7-adapter`.

**I urge you to implement the optional caching implementation**

- For `PSR-6: Caching Interface`, for example `symfony/cache`.
- For `PSR-16: Simple Cache`, for example `symfony/cache`.

_Optional dependencies_

- For `PSR-3: Logger Interface`, for example `monolog/monolog`, 

If the required dependencies above are met, you are ready to install the library.

```shell script
composer require php-tmdb/api:^4
```

Include Composer's autoloader:

```php
require_once dirname(__DIR__).'/vendor/autoload.php';
```

To use the examples provided, copy the `apikey.php.dist` to `apikey.php` and change the settings.

### New to PSR standards or composer?

If you came here looking to start a fun project to start learning, the above might seem a little daunting.

Don't worry! The documentation here was setup with beginners in mind as well.

We also provide a bunch of examples in the `examples/` folder.

To get started;

```shell script
composer require php-tmdb/api:dev-release/4.0.0 nyholm/psr7 symfony/dependency-injection symfony/event-dispatcher php-http/guzzle7-adapter symfony/cache monolog/monolog
```

This will install the library without issues as all requirements will be met, you will be presented with the following output;

```shell script
# Dependencies per 30-12-2020
$ composer require php-tmdb/api:^4 nyholm/psr7 symfony/dependency-injection symfony/event-dispatcher php-http/guzzle7-adapter symfony/cache monolog/monolog
Using version ^1.3 for nyholm/psr7
Using version ^5.2 for symfony/dependency-injection
Using version ^5.2 for symfony/event-dispatcher
Using version ^0.1.1 for php-http/guzzle7-adapter
Using version ^5.2 for symfony/cache
Using version ^2.2 for monolog/monolog
./composer.json has been created
# --- cut ---
```

Now that we have everything we need installed, let's get started setting up to be able to use the library.

## Quick setup

Review the `examples/setup.php` file and `examples/movies/model/get.php` or `examples/movies/model/get.php` files.

## Constructing the Client

_If you have chosen different implementations than the examples suggested beforehand, obviously all the upcoming documentation won't match. Adjust accordingly to your dependencies, we will go along with the examples given earlier._

### @TODO rewrite chapter from scratch 

## General API Usage

If you're looking for a simple array entry point the API namespace is the place to be, however we recommend you use the 
repositories and model's functionality up ahead.

```php
$movie = $client->getMoviesApi()->getMovie(550);
```

If you want to provide any other query arguments.

```php
$movie = $client->getMoviesApi()->getMovie(550, array('language' => 'en'));
```

For all further calls just review the unit tests or examples provided, or the API classes themselves.

## Model Usage

However the library can also be used in an object oriented manner, which I reckon is the __preferred__ way of doing things.

Instead of calling upon the client, you pass the client onto one of the many repositories and do then some work on it.

```php
$repository = new \Tmdb\Repository\MovieRepository($client);
$movie      = $repository->load(87421);

echo $movie->getTitle();
```

__The repositories also contain the other API methods that are available through the API namespace.__

```php
$repository = new \Tmdb\Repository\MovieRepository($client);
$topRated = $repository->getTopRated(array('page' => 3));
// or
$popular = $repository->getPopular();
```

For all further calls just review the unit tests or examples provided, or the model's themselves.

## Event Dispatching

We dispatch the following events inside the library, which by using event listeners you could modify some behavior.

### Hydration

- `Tmdb\Event\AfterHydrationEvent`
  - Allows modification of the eventual subject returned.
- `Tmdb\Event\BeforeHydrationEvent`
  - Allows modification of the response data before being hydrated.
  
### Requests & Responses  
- `Tmdb\Event\BeforeRequestEvent`
  - Allows modification of the PSR-7 request data before being sent.
  - Allows early response behavior ( think of caching ), by calling `$event->isPropagated()` in your listener.
- `Tmdb\Event\ResponseEvent`
  - Contains the `Request` object.
  - Allows modification of the PSR-7 response before being hydrated.
  - Allows end-user to implement their own cache, or any other actions you'd like to perform on the given response. 

## Event listeners 

We have a small couple of optional event listeners that you could add to provide additional functionality.

### Adult filter

@todo

### Language filter

@todo

### Region filter

@todo

## Image Helper

An `ImageHelper` class is provided to take care of the images, which does require the configuration to be loaded:

```php
$configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
$config = $configRepository->load();

$imageHelper = new \Tmdb\Helper\ImageHelper($config);

echo $imageHelper->getHtml($image, 'w154', 154, 80);
```


## Collection Filtering

We also provide some easy methods to filter any collection, you should note however you can always implement your own filter easily by using Closures:

```php
foreach($movie->getImages()->filter(
        function($key, $value){
            if ($value instanceof \Tmdb\Model\Image\PosterImage) { return true; }
        }
    ) as $image) {

    // do something with all poster images
}
```

These basic filters however are already covered in the `Images` collection object:

```php
$backdrop = $movie
    ->getImages()
    ->filterBackdrops()
;
```
_And there are more Collections which provide filters, but you will find those out along the way._

### The `GenericCollection` and the `ResultCollection`

The `GenericCollection` holds any collection of objects (e.g. an collection of movies).

The `ResultCollection` is an extension of the `GenericCollection`, and inherits the response parameters _(page, total_pages, total_results)_ from an result set,
this can be used to create pagination.

## Help & Donate

If you use this in a project whether personal or business, I'd like to know where it is being used, __so please drop me an e-mail!__ :-)

If this project saved you a bunch of work, or you just simply appreciate my efforts, please consider donating a beer (or two ;))!

<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SMLZ362KQ8K8W"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"></a>
