# :
[![License](https://img.shields.io/github/license/:tallandsassy/:page-guide)](https://github.com/:tallandsassy/:page-guide/blob/master/LICENSE.md)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/:tallandsassy/:page-guide.svg?style=flat-square)](https://packagist.org/packages/:tallandsassy/:page-guide)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/:tallandsassy/:page-guide/run-tests?label=tests)](https://github.com/:tallandsassy/:page-guide/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Coverage Status](https://coveralls.io/repos/github/:tallandsassy/:page-guide/badge.svg?branch=master)](https://coveralls.io/github/:tallandsassy/:page-guide?branch=master)

[![Total Downloads](https://img.shields.io/packagist/dt/:tallandsassy/:page-guide.svg?style=flat-square)](https://packagist.org/packages/:tallandsassy/:page-guide)


Provide basic page flow for front, admin, and user pages


## Installation

You can install the package via composer:

[ ] Make a local table for testing called 'tmp_laravel_package' (per 'phpunit.xml')

```bash
composer require tallandsassy/page-guide
```


```php
# in routes/web.php
require_once(base_path('vendor/tallandsassy/page-guide/routes/web.php'));

# in app/Providers/RouteServiceProvider.php
# Change
    public const HOME = '/dashboard';
  # -to- 
    public const HOME = '/me';
```

## Icons for Admin Menus
Visit: https://blade-ui-kit.com/blade-icons/heroicon-o-home


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [:JJ Rohrer](https://github.com/:JJRohrer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
