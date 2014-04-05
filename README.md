A PHP Wrapper for use with the [TMDB API](http://http://docs.themoviedb.apiary.io/).
---------------
[![Build Status Develop Branch](https://travis-ci.org/wtfzdotnet/php-tmdb-api.png?branch=develop)](https://travis-ci.org/wtfzdotnet/php-tmdb-api)
[![Code Coverage](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/badges/coverage.png?s=d416e063debb3b400e9b1bc9db019f54cc1dc40e)](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/badges/quality-score.png?s=dad36710f36335bdeffeaf2ac256c222862832fa)](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/)
[![License](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/license.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)

Inspired by [php-github-api](https://github.com/KnpLabs/php-github-api), [php-gitlab-api](https://github.com/m4tthumphrey/php-gitlab-api/) and the Symfony2 Community.

If you have any questions or feature requests, please visit the [google+ community](https://plus.google.com/communities/113544625011244846907).

Stable
----------------

[![Latest Stable Version](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/v/stable.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)
[![Latest Unstable Version](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/v/unstable.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)
[![Dependency Status](https://www.versioneye.com/user/projects/530a7514ec137594df000010/badge.png)](https://www.versioneye.com/user/projects/530a7514ec137594df000010)

Currently unit tests are run on travis, with the following versions:

- 5.3.3
- 5.3
- 5.4
- 5.5
- 5.6
- hhvm _( we do not officially support this, however tests indicate it should be functional. )_

Help & Donate
--------------

If you use this in a project whether personal or business, I'd like to know where it is being used, __so please drop me an e-mail :-)__!

If this project saved you a bunch of work, or you just simply appreciate my efforts, please consider donating a beer ( or two ;) )!

<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SMLZ362KQ8K8W"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"></a>

Features
--------

- An complete integration of TMDB ( accounts, movies, tv etc. _if something is missing I haven't added the updates yet!_ ).
- Array implementation of the movie database
- Model implentation of the movie database _trying to follow their model as closely as possible_.
- An `ImageHelper` class to help build image urls or html <img> elements.
- BackoffRetry plugin enabled by default to handle any rate limit errors.
- Caching support based on `max-age` headers returned by TMDB, requires `doctrine-cache`.
- Logging support, requires `monolog`.

Plug-ins
--------

- Symfony2
  - [wtfzdotnet/WtfzTmdbBundle](https://github.com/wtfzdotnet/WtfzTmdbBundle)

Installation
------------
Install Composer

```
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

Add the following to your require block in composer.json config

```
"wtfzdotnet/php-tmdb-api": ">=1.1.0"
```

Include Composer's autoloader:


```php
require_once dirname(__DIR__).'/vendor/autoload.php';
```

#### New to composer?

Just create a file named `composer.json` in your document root:

```
{
    "require": {
        "wtfzdotnet/php-tmdb-api": ">=1.1.0"
    }
}
```

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

_This relies on max-age headers being sent back from TMDB, see the [documentation of the CachePlugin](http://guzzle.readthedocs.org/en/latest/plugins/cache-plugin.html)._

If you want to add some logging capabilities ( currently an implementation of the `GuzzleLogPlugin`, requires `monolog/monolog`);

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

_This relies on max-age headers being sent back from TMDB, see the [documentation of the CachePlugin](http://guzzle.readthedocs.org/en/latest/plugins/cache-plugin.html)._

If you want to add some logging capabilities ( currently an implementation of the `GuzzleLogPlugin`, requires `monolog/monolog`);

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

__There are 2 types of "main" collections, the `GenericCollection` and the `ResultCollection`.__

The `GenericCollection holds any collection of objects ( e.g. an collection of movies ).

The `ResultCollection` is an extension of the `GenericCollection`, and inherits response parameters _( page, total_pages, total_results )_ from an resultset,
this can be used to create paginators.