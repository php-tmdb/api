A PHP Wrapper for use with the [TMDB API](http://docs.themoviedb.apiary.io/).
---------------
[![License](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/license.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)
[![Build Status](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/badges/build.png?b=2.0-WIP)](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/build-status/2.0-WIP)
[![Code Coverage](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/badges/coverage.png?b=2.0-WIP)](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/?branch=2.0-WIP)
[![HHVM Status](http://hhvm.h4cc.de/badge/wtfzdotnet/php-tmdb-api.svg)](http://hhvm.h4cc.de/package/wtfzdotnet/php-tmdb-api)

Inspired by [php-github-api](https://github.com/KnpLabs/php-github-api), [php-gitlab-api](https://github.com/m4tthumphrey/php-gitlab-api/) and the Symfony2 Community.

If you have any questions or feature requests, please visit the [google+ community](https://plus.google.com/communities/113544625011244846907).

Stable
----------------

[![Latest Stable Version](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/v/stable.svg)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)
[![Latest Unstable Version](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/v/unstable.svg)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)
[![Dependency Status](https://www.versioneye.com/user/projects/530a7514ec137594df000010/badge.png)](https://www.versioneye.com/user/projects/530a7514ec137594df000010)
[![Total Downloads](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/downloads.svg)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)

Currently unit tests are run on travis, with the following versions:

- 5.4
- 5.5
- 5.6
- HHVM

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
  - [wtfzdotnet/WtfzTmdbBundle](https://github.com/wtfzdotnet/WtfzTmdbBundle)
- Laravel
  - [wtfzdotnet/tmdb-package](https://github.com/wtfzdotnet/tmdb-package)

Installation
------------

Install Composer

```
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

Add the following to your require block in composer.json config

```
"wtfzdotnet/php-tmdb-api": "~2.0"
```

__If your new to composer and have no clue what I'm talking about__

Just create a file named `composer.json` in your document root:

```
{
    "require": {
        "wtfzdotnet/php-tmdb-api": "~2.0"
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

General API Usage
-----------------

If your looking for a simple array entry point the API namespace is the place to be.

First we always have to construct the client:

```php
$token  = new \Tmdb\ApiToken('your_tmdb_api_key_here');
$client = new \Tmdb\Client($token);
```

Or if you prefer requests to happen securely:

```php
$client = new \Tmdb\Client($token, null, true);
```

If you want to add some caching capabilities ( currently an implementation of the `GuzzleCachePlugin` );

```php
$client->setCaching(true, '/tmp/php-tmdb-api');
```

_This relies on max-age headers being sent back from TMDB, see the [documentation of the CacheSubscriber](https://github.com/guzzle/cache-subscriber)._

If you want to add some logging capabilities ( requires `monolog/monolog` if you make use of the default http adapter );

```php
$client->setLogging(true, '/tmp/php-tmdb-api.log');
```

Then we do some work on it:

```php
$movie = $client->getMoviesApi()->getMovie(550);
```

If you want to provide any other query arguments.

```php
$movie = $client->getMoviesApi()->getMovie(550, array('language' => 'en'));
```

Model Usage
-----------

However the library can also be used in an object oriented manner.

First we always have to construct the client:

```php
$token  = new \Tmdb\ApiToken('your_tmdb_api_key_here');
$client = new \Tmdb\Client($token);
```

Or if you prefer requests to happen securely:

```php
$client = new \Tmdb\Client($token, null, true);
```

If you want to add some caching capabilities ( currently an implementation of the `GuzzleCachePlugin` );

```php
$client->setCaching(true, '/tmp/php-tmdb-api');
```

_This relies on max-age headers being sent back from TMDB, see the [documentation of the CacheSubscriber](https://github.com/guzzle/cache-subscriber)._

If you want to add some logging capabilities ( requires `monolog/monolog` if you make use of the default http adapter );

```php
$client->setLogging(true, '/tmp/php-tmdb-api.log');
```

Then you pass this client onto one of the many repositories and do some work on it.

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

An `ImageHelper` class is provided to take care of the images, which does require the configuration to be loaded:

```php
$configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
$config = $configRepository->load();

$imageHelper = new \Tmdb\Helper\ImageHelper($config);

echo $imageHelper->getHtml($image, 'w154', 154, 80);
```

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

Some other useful hints
-----------------------

__Event Dispatching system.__

Since 2.0 requests are handled by the `EventDispatcher`, which gives you before and after hooks, the before hook allows an event to stop propagation for the
request event, meaning you are able to stop the main request from happening, you will have to set a `Response` object in that event though.

See the files for [TmdbEvents](blob/2.0-WIP/lib/Tmdb/Event/TmdbEvents.php) and [RequestSubscriber](blob/2.0-WIP/lib/Tmdb/Event/RequestSubscriber.php#L32) respectively.

__There are 2 types of "main" collections, the `GenericCollection` and the `ResultCollection`.__

The `GenericCollection holds any collection of objects ( e.g. an collection of movies ).

The `ResultCollection` is an extension of the `GenericCollection`, and inherits response parameters _( page, total_pages, total_results )_ from an result set,
this can be used to create paginators.

Help & Donate
--------------

If you use this in a project whether personal or business, I'd like to know where it is being used, __so please drop me an e-mail :-)__!

If this project saved you a bunch of work, or you just simply appreciate my efforts, please consider donating a beer ( or two ;) )!

<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SMLZ362KQ8K8W"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"></a>
