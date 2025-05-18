# UPGRADE-CURRENT.md

## Changes in this version

- Removed `rtheunissen/guzzle-log-middleware` dependency due to compatibility issues with Guzzle 7.0. This middleware is temporarily removed and may be reintroduced in a future release once compatibility is resolved.
- Added support for Symfony 7 components. Note that Symfony 7 requires PHP 8.1 or higher. If you're using PHP < 8.1, Composer will automatically select a compatible Symfony version (4, 5, or 6).
- Dropped support for PHP 7.4 and 8.0 as they have reached End-of-Life (EOL). The minimum required PHP version is now 8.1.