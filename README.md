A PHP Wrapper for use with the [TMDB API](http://http://docs.themoviedb.apiary.io/).
==============
[![Build Status Develop Branch](https://travis-ci.org/wtfzdotnet/php-tmdb-api.png?branch=develop)](https://travis-ci.org/wtfzdotnet/php-tmdb-api)
[![Code Coverage](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/badges/coverage.png?s=d416e063debb3b400e9b1bc9db019f54cc1dc40e)](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/badges/quality-score.png?s=dad36710f36335bdeffeaf2ac256c222862832fa)](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/)
[![Latest Stable Version](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/v/stable.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)
[![Total Downloads](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/downloads.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)
[![Latest Unstable Version](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/v/unstable.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)
[![License](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/license.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)

Inspired by [php-github-api](https://github.com/KnpLabs/php-github-api) and [php-gitlab-api](https://github.com/m4tthumphrey/php-gitlab-api/).

** WARNING, The model namespace is not ready for production yet, however the API namespace should be stabilizing by now so feel free to try it out. **


As you can see the code coverage is very low at the moment, as it only covers the API section right now.

Work is being put into reaching at least 80%, but this will take some time.

Work in progress
----------------

The API namespace has most things already covered, however this is RAW output from the API.

I'm working extensively on finishing the models, which should provide a more natural feeling of working with TMDB.

Help & Donate
--------------

If this project saved you a bunch of work, or you just simply appreciate my efforts, please consider donating a beer ( or two ;) )!

<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SMLZ362KQ8K8W"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"></a>

Installation
------------
Install Composer

```
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

Add the following to your require block in composer.json config.

```
"wtfzdotnet/php-tmdb-api": "dev-develop"
```

Include Composer's autoloader:


```php
require_once dirname(__DIR__).'/vendor/autoload.php';
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

Then we do some work on it:

```php
$images = $client->getMoviesApi()->getMovie(550);
```

If you want to provide any other query arguments.

```php
$images = $client->getMoviesApi()->getMovie(550, array('language' => 'en'));
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

Then you pass this client onto one of the many repositories and do some work on it.

```php
$repository = new \Tmdb\Repository\MovieRepository($client);
$movie      = $repository->load(87421);

echo $movie->getTitle();
```

__The repositories also contain the other API methods that are available through the API namespace.__

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

__And there are more Collections which provide filters, but you will find those out along the way.__