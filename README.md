Work in progress
----------------

I've started working on this since the week of October-November 2013. I hope to finish this within a week or two, if you feel like lending a hand please contribute, wether it's documentation or code they are both more than welcome!

The API namespace has most things already covered, however this is RAW output from the API. I'm working extensively on finishing the models.

A PHP Wrapper for use with the [TMDB API](http://http://docs.themoviedb.apiary.io/).
------------

Based on & inspired by [php-github-api](https://github.com/KnpLabs/php-github-api) and [php-gitlab-api](https://github.com/m4tthumphrey/php-gitlab-api/).

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

Please take a look at the (currently few) examples in the examples directory.

Model Usage
-----------

`todo`