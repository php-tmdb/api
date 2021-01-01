Upgrading to 4.0
----------------

4.0 brings a massive refreshment to this library, and thus the upgrade path involves a little more than you have
been used to in the past.

**Important**

- I've decided to drop anything below PHP 7.3, even though at this point security fixes have support for 7.2, we consider 7.2 EOL.
- During the modifications I've tried my best to maintain as many backwards compatibility in mind as possible, but as you 
could expect with a major version; things might break on your end.

**This update involves**

- (Re-Implementation) of PSR-3
- Implementation of PSR-7
- Implementation of PSR-12
- Implementation of PSR-14
- Implementation of PSR-16
- Implementation of PSR-17
- Implementation of PSR-18
- Cleanup of tests
- Dropping doctrine cache ( bring your own PSR-16 client )
- Dropping guzzle http ( bring your own PSR-18 client )
- New CI/CD integration ( github actions, as travis-ci is being abandoned )
    - Code style checking
    - Unit tests running on PHP 7.3, 7.4 and 8.0 ( still allowing failures as of now )

The good news
=============

Just to give you a little sense of relief, besides adding the necessary type hints, the user API for the `Tmdb/Api` calls and `Tmdb/Repository` namespaces will **not** change.
If you have custom API classes or Repository classes these will need to be adjusted.

Plugins were really just event listeners
----------------------------------------

Review the new listeners in `lib/Tmdb/Event/Listener`, if you made use of an extra plugin before, 
they were moved here and renamed.

With this release also the new `Tmdb/Event/Listener/RegionFilterRequestListener` was introduced.

@todo since library isn't fully done, can't write much yet about PSR-14

Request and Responses
---------------------

The base request and response classes internally are gone, as well as the adapter interfacing that was present.

Where you used to be able to rely on an internal library request / response within events, you will now have to 
modify your code to adhere to PSR-7. The internals now also rely on an PSR-18 client to be provided,
 the http factories from PSR-17 and request and response messages according to PSR-7.
 
Registering the event listeners ( yourself )
--------------------------------------------

_we could create a callback function the user gives, and call that to register each listener?_

- ExampleEvent::class => new ExampleListener($deps)
 
Hydration Events
----------------

The hydration events caused a significant overhead, as such it has been disabled by default.

To re-enable this functionality, we recommend only using it for models you need to modify data for;

```php
$client = new \Tmdb\Client([
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
// Or any other PSR-14 compliant Event Dispatcher
$eventDispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
$hydrationListener = new \Tmdb\Event\Listener\HydrationListener($eventDispatcher);
$eventDispatcher->addListener(\Tmdb\Event\HydrationEvent::class, $hydrationListener);
```

_If you re-enable this functionality without specifying any models, all hydration will be done through the event listeners._
