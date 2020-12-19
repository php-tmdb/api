Upgrading to 3.0
----------------

3.0 brings a massive refreshment to this library, and thus the upgrade path involves a little more than you have
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

Defaults
--------

We used to always bring sensible defaults, **from now it is your responsibility to register a caching provider**.

As much I'd love to 

Request and Responses
=====================

Where you used to be able to rely on an internal library request / response within events, you will now have to 
modify your code to adhere to PSR-7. We also have 
