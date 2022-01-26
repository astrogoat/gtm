# A Gtm app for Strata

[![Latest Version on Packagist](https://img.shields.io/packagist/v/astrogoat/gtm.svg?style=flat-square)](https://packagist.org/packages/astrogoat/gtm)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/astrogoat/gtm/run-tests?label=tests)](https://github.com/astrogoat/gtm/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/astrogoat/gtm/Check%20&%20fix%20styling?label=code%20style)](https://github.com/astrogoat/gtm/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/astrogoat/gtm.svg?style=flat-square)](https://packagist.org/packages/astrogoat/gtm)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require astrogoat/gtm
```

## Usage
This will require two includes to be added to `BRAND/layout/app.blade.php`

```php
<head> 
    ...
    @include('gtm::header-script')
</head>

<body>
    ...
    @include('gtm::body-script')
</body>
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Brett M](https://github.com/bmmage)
- [All Contributors](../../contributors)



## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
