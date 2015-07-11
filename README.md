A PHP Wrapper for use with the [TMDB API](http://docs.themoviedb.apiary.io/).
---------------
[![License](https://poser.pugx.org/php-tmdb/api/license.png)](https://packagist.org/packages/php-tmdb/api)
[![Build Status](https://travis-ci.org/php-tmdb/api.svg?branch=2.0)](https://travis-ci.org/php-tmdb/api)
[![Code Coverage](https://scrutinizer-ci.com/g/php-tmdb/api/badges/coverage.png?b=2.0)](https://scrutinizer-ci.com/g/php-tmdb/api/?branch=2.0)
[![HHVM Status](http://hhvm.h4cc.de/badge/php-tmdb/api.svg)](http://hhvm.h4cc.de/package/php-tmdb/api)

Inspired by [php-github-api](https://github.com/KnpLabs/php-github-api), [php-gitlab-api](https://github.com/m4tthumphrey/php-gitlab-api/) and the Symfony2 Community.

If you have any questions or feature requests, please visit the [google+ community](https://plus.google.com/communities/113544625011244846907).

Stable
----------------

[![Latest Stable Version](https://poser.pugx.org/php-tmdb/api/v/stable.svg)](https://packagist.org/packages/php-tmdb/api)
[![Latest Unstable Version](https://poser.pugx.org/php-tmdb/api/v/unstable.svg)](https://packagist.org/packages/php-tmdb/api)
[![Dependency Status](https://www.versioneye.com/user/projects/551fe134971f7847ca000451/badge.svg?style=flat)](https://www.versioneye.com/user/projects/551fe134971f7847ca000451)
[![Total Downloads](https://poser.pugx.org/php-tmdb/api/downloads.svg)](https://packagist.org/packages/php-tmdb/api)

Currently unit tests are run on travis, with the following versions:

- 5.4
- 5.5
- 5.6
- 7 ( failures allowed )
- nightly ( failures allowed )
- HHVM ( failures allowed )

Features
--------

**Main features**

- An complete integration of all the TMDB API has to offer ( accounts, movies, tv etc. _if something is missing I haven't added the updates yet!_ ).
- Array implementation of the movie database ( RAW )
- Model implementation of the movie database ( By making use of the repositories )
- An `ImageHelper` class to help build image urls or html <img> elements.

**Other things worth mentioning**

- Retry subscriber enabled by default to handle any rate limit errors.
- Caching subscriber enabled by default, based on `max-age` headers returned by TMDB, requires `doctrine-cache`.
- Logging subscriber and is optional, requires `monolog`. Could prove useful during development.

Plug-ins
--------

- Symfony2
  - [php-tmdb/symfony](https://github.com/php-tmdb/symfony), _yet to updated to 2.0_.
- Laravel
  - [php-tmdb/laravel](https://github.com/php-tmdb/laravel).

Installation
------------

Install Composer

```
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```
_You are not obliged to move the composer.phar file to your /usr/local/bin, it is however considered easy to have an global installation._

Add the following to your require block in composer.json config

```
"php-tmdb/api": "~2.0"
```

__If your new to composer and have no clue what I'm talking about__

Just create a file named `composer.json` in your document root:

```
{
    "require": {
        "php-tmdb/api": "~2.0"
    }
}
```

Now let's install and pull in the dependencies!

```
composer install
```

Include Composer's autoloader:

```php
require_once dirname(__DIR__).'/vendor/autoload.php';
```

To use the examples provided, copy the apikey.php.dist to apikey.php and change the settings. 

Constructing the Client
-----------------------

First we always have to construct the client:

```php
$token  = new \Tmdb\ApiToken('your_tmdb_api_key_here');
$client = new \Tmdb\Client($token);
```

If you'd like to make unsecure requests ( by __default__ we use secure requests ).

```php
$client = new \Tmdb\Client($token, ['secure' => false]);
```

Caching is enabled by default, and uses a slow filesystem handler, which you can either:

    Replace the `path` of the storage of, by supplying the option in the client:
    
```php
$client = new \Tmdb\Client($token, [
    'cache' => [
        'enabled' => false,
        'path'    => '/tmp/php-tmdb-api.log'
    ]
]);
```
    Or replace the whole implementation with another CacheStorage of Doctrine:
    
```php
$client = new \Tmdb\Client($token, [
    'cache' => [
        'enabled' => false,
        'storage' => new \Doctrine\Common\Cache\ArrayCache()
        )
    ]
]);
```
_This will only keep cache in memory during the length of the request,  see the [documentation of Doctrine Cache](http://doctrine-common.readthedocs.org/en/latest/reference/caching.html) for the available adapters._

If you want to add some logging capabilities ( requires `monolog/monolog` ), defaulting to the filesystem;

```php
$client = new \Tmdb\Client($token, [
    'log' => [
        'enabled' => true,
        'path'    => '/var/www/php-tmdb-api.log'
        )
    ]
]);
```

However during development you might like some console magic like `ChromePHP` or `FirePHP`;

```php
$client = new \Tmdb\Client($token, [
    'log' => [
        'enabled' => true,
        'handler' => new \Monolog\Handler\ChromePHPHandler()
        )
    ]
]);
```

General API Usage
-----------------

If your looking for a simple array entry point the API namespace is the place to be.

```php
$movie = $client->getMoviesApi()->getMovie(550);
```

If you want to provide any other query arguments.

```php
$movie = $client->getMoviesApi()->getMovie(550, array('language' => 'en'));
```

Model Usage
-----------

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

Some other useful hints
-----------------------

### Event Dispatching

Since 2.0 requests are handled by the `EventDispatcher`, which gives you before and after hooks, the before hook allows an event to stop propagation for the
request event, meaning you are able to stop the main request from happening, you will have to set a `Response` object in that event though.

See the files for [TmdbEvents](lib/Tmdb/Event/TmdbEvents.php) and [RequestSubscriber](lib/Tmdb/Event/RequestSubscriber.php) respectively.

### Image Helper

An `ImageHelper` class is provided to take care of the images, which does require the configuration to be loaded:

```php
$configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
$config = $configRepository->load();

$imageHelper = new \Tmdb\Helper\ImageHelper($config);

echo $imageHelper->getHtml($image, 'w154', 154, 80);
```

### Plug-ins

At the moment there are only two useful plug-ins that are not enabled by default, and you might want to use these:

```php
$plugin = new \Tmdb\HttpClient\Plugin\LanguageFilterPlugin('nl');
```
_Tries to fetch everything it can in Dutch._

```php
$plugin = new \Tmdb\HttpClient\Plugin\AdultFilterPlugin(true);
```
_We like naughty results, if configured this way, provide `false` to filter these out._

### Collection Filtering

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

The `GenericCollection` holds any collection of objects ( e.g. an collection of movies ).

The `ResultCollection` is an extension of the `GenericCollection`, and inherits the response parameters _( page, total_pages, total_results )_ from an result set,
this can be used to create paginators.

Help & Donate
--------------

If you use this in a project whether personal or business, I'd like to know where it is being used, __so please drop me an e-mail :-)__!

If this project saved you a bunch of work, or you just simply appreciate my efforts, please consider donating a beer ( or two ;) )!

<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SMLZ362KQ8K8W"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"></a>
