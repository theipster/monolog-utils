# monolog-utils
Common features for Monolog

## `RequestHeaderProcessor`

Takes a PSR-7 request, attempts to extract a specified HTTP header, and then injects the value into the log message.

Example usage:

```php
use Monolog\Logger;
use TheIpster\MonologUtils\RequestHeaderProcessor;

// Marshal superglobals into a PSR-7 request.
$request = ...;

// Build logger.
$logger = Logger(...);
$logger->pushProcessor(new RequestHeaderProcessor($request, 'X-My-Custom-Header', 'my_custom_header'));

// Log stuff.
$logger->info('Some message.');
```

## `XRequestIdProcessor`

A specific variation of `RequestHeaderProcessor`, focusing on the `X-Request-ID` HTTP header.

By default, the value is injected as `'request_id'`.

Example usage:

```php
use Monolog\Logger;
use TheIpster\MonologUtils\XRequestIdProcessor;

// Marshal superglobals into a PSR-7 request.
$request = ...;

// Build logger.
$logger = Logger(...);
$logger->pushProcessor(new XRequestIdProcessor($request));

// Log stuff.
$logger->info('Some message.');
```
