Upgrading to 2.0
----------------

The `Client` constructor has been simplified, and now is initialised as so:

```php
$client = new \Tmdb\Client($apiToken, $options);
```

If you used the old constructor, this is how you define the same options from 2.0 and onward:

```php
$client = new \Tmdb\Client($apiToken, [
    'adapter' => new FooBarAdapter(),
    'secure'  => false,
]);
```

If you'd like to set a session for the current request cycle:

```php
$client = new \Tmdb\Client($apiToken, [
    'session_token' => new SessionToken(TMDB_SESSION_TOKEN)
]);
```
