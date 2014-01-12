A PHP Wrapper for use with the [TMDB API](http://http://docs.themoviedb.apiary.io/).
==============

Inspired by [php-github-api](https://github.com/KnpLabs/php-github-api) and [php-gitlab-api](https://github.com/m4tthumphrey/php-gitlab-api/).

** WARNING, The model namespace is not ready for production yet, however the API namespace should be stabilizing by now so feel free to try it out. **

Work in progress
----------------

I've started working on this since the week of October-November 2013. I hoped to finish this pretty quick but I've been slammed with work, if you feel like lending a hand please contribute, wether it's documentation or code they are both more than welcome!

The API namespace has most things already covered, however this is RAW output from the API. I'm working extensively on finishing the models, which should provide a more natural feeling of working with TMDB.

Help & Donate
--------------

If this project saved you a bunch of work, or you just simply appreciate my efforts, please consider donating a beer ( or two ;) )!

<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SMLZ362KQ8K8W"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"></a>

Update 12-jan
--------------

Been able to do some work the past 2 days, API namespace has had it's last big refactorings, although it's still missing the account functionalities.

Update 18-nov
--------------

I've been hammered with work and had some time in the past few days to work on some things, please see the commit messages.

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

Basically the Repositories are used as the entry-point, take a look in the examples or better yet browse the code.