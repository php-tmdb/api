A PHP Wrapper for use with the [TMDB API](http://http://docs.themoviedb.apiary.io/).
==============
[![Build Status Develop Branch](https://travis-ci.org/wtfzdotnet/php-tmdb-api.png?branch=develop)](https://travis-ci.org/wtfzdotnet/php-tmdb-api)
[![Code Coverage](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/badges/coverage.png?s=d416e063debb3b400e9b1bc9db019f54cc1dc40e)](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/badges/quality-score.png?s=dad36710f36335bdeffeaf2ac256c222862832fa)](https://scrutinizer-ci.com/g/wtfzdotnet/php-tmdb-api/)
[![License](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/license.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)

Inspired by [php-github-api](https://github.com/KnpLabs/php-github-api), [php-gitlab-api](https://github.com/m4tthumphrey/php-gitlab-api/) and the Symfony2 Community.

Stable
----------------

[![Latest Stable Version](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/v/stable.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)

__The model/factory/repository namespaces are not ready for production yet, however the API namespace is considered stable up unto how far we implemented it ( account functions are not present yet ).__

Currently there is no stable version as I don't consider everything ready yet, however you should be able to use the API namespace without issues.

Do note that this is just raw output from The Movie Database API.

Unstable
----------------

[![Latest Unstable Version](https://poser.pugx.org/wtfzdotnet/php-tmdb-api/v/unstable.png)](https://packagist.org/packages/wtfzdotnet/php-tmdb-api)

I'm working extensively on finishing the models/repositories/factories, which should allow you to simply jump in with an API key and implement quickly.

Do expect changes to happen a few times per week until the work is done, however structurally seen things will be built further upon the current base.

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

[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/wtfzdotnet/php-tmdb-api/trend.png)](https://bitdeli.com/free "Bitdeli Badge")