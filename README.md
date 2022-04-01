# A GTM (Google Tag Manager) app for Strata

[![Latest Version on Packagist](https://img.shields.io/packagist/v/astrogoat/gtm.svg?style=flat-square)](https://packagist.org/packages/astrogoat/gtm)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/astrogoat/gtm/run-tests?label=tests)](https://github.com/astrogoat/gtm/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/astrogoat/gtm/Check%20&%20fix%20styling?label=code%20style)](https://github.com/astrogoat/gtm/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/astrogoat/gtm.svg?style=flat-square)](https://packagist.org/packages/astrogoat/gtm)

## Installation

You can install the package via composer:

```bash
composer require astrogoat/gtm
```

If you plan on using the [flash-functionality](#flashing-data-for-the-next-request) you must install the GoogleTagManagerMiddleware, after the StartSession middleware:

```php
// app/Http/Kernel.php

protected $middleware = [
    ...
    \Illuminate\Session\Middleware\StartSession::class,
    \Spatie\GoogleTagManager\GoogleTagManagerMiddleware::class,
    ...
];
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

Your base dataLayer will also be rendered here. To add data, use the `set()` function.

```php
// HomeController.php

public function index()
{
    GoogleTagManager::set('pageType', 'productDetail');

    return view('home');
}
```

This renders:

```html
<html>
  <head>
    <script>dataLayer = [{"pageType":"productDetail"}];</script>
    <script>/* Google Tag Manager's script */</script>
    <!-- ... -->
  </head>
  <!-- ... -->
</html>
```

### Flashing data for the next request

The package can also set data to render on the next request. This is useful for setting data after an internal redirect.

```php
// ContactController.php

public function getContact()
{
    GoogleTagManager::set('pageType', 'contact');

    return view('contact');
}

public function postContact()
{
    // Do contact form stuff...

    GoogleTagManager::flash('formResponse', 'success');

    return redirect()->action('ContactController@getContact');
}
```

After a form submit, the following dataLayer will be parsed on the contact page:

```html
<html>
  <head>
    <script>dataLayer = [{"pageType":"contact","formResponse":"success"}];</script>
    <script>/* Google Tag Manager's script */</script>
    <!-- ... -->
  </head>
  <!-- ... -->
</html>
```

### Other Simple Methods

```php
// Retrieve your Google Tag Manager id
$id = GoogleTagManager::id(); // GTM-XXXXXX

// Check whether script rendering is enabled
$enabled = GoogleTagManager::isEnabled(); // true|false

// Add data to the data layer (automatically renders right before the tag manager script). Setting new values merges them with the previous ones. Set also supports dot notation.
GoogleTagManager::set(['foo' => 'bar']);
GoogleTagManager::set('baz', ['ho' => 'dor']);
GoogleTagManager::set('baz.ho', 'doorrrrr');

// [
//   'foo' => 'bar',
//   'baz' => ['ho' => 'doorrrrr']
// ]
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
