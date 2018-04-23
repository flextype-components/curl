# Curl Component
![version](https://img.shields.io/badge/version-1.0.0-brightgreen.svg?style=flat-square "Version")
[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/flextype-components/curl/blob/master/LICENSE)

The Curl Component contains methods that makes it easy to send HTTP requests and integrate with web APIs

### Installation

```
composer require flextype-components/curl
```

### Usage

```php
use Flextype\Component\Curl\Curl;
```

Performs a curl GET request.
```php
$res = Curl::get('http://site.com/');
```

Performs a curl POST request.
```php
$res = Curl::post('http://site.com/login');
```

Gets information about the last transfer.
```php
$res = Curl::getInfo();
```

## License
See [LICENSE](https://github.com/flextype-components/curl/blob/master/LICENSE)
