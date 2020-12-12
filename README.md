# Simple Flash Messages for Laravel Framework Applications

This package allows to use Bootstrap flash messaging for Laravel framework applications.

## Installation

Begin by pulling in the package through Composer.

```bash
composer require apphp/flashes
```

## Usage

In your controllers, before you perform a redirect or render a view, make a call to the `flashes()` function.

```php
public function store()
{
    flashes('Welcome Message!');

    return redirect()->route('home');
}
```

To show messages on view files, use the following:

```html
@include('flashes::message')
```