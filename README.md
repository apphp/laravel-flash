# Simple Flash Messages for Laravel Framework Applications

This package allows to use Bootstrap 3/4 flash messaging for Laravel framework applications.

## Installation

Begin by pulling in the package through Composer.

```bash
composer require apphp/flash
```

## Usage

In your controllers, before you perform a redirect or render a view, make a call to the `flash()` function.

```php
public function store()
{
    flash('Welcome Message!');

    return redirect()->route('home');
}
```

You may also define following flash messages:

- `flash('your-message', 'primary')`: Set the flash type to "primary".
- `flash('your-message', 'secondary')`: Set the flash type to "secondary".
- `flash('your-message', 'success')`: Set the flash type to "success".
- `flash('your-message', 'danger')`: Set the flash type to "error".
- `flash('your-message', 'error')`: Set the flash type to "error" (alias to "danger").
- `flash('your-message', 'warning')`: Set the flash type to "error".
- `flash('your-message', 'error')`: Set the flash type to "error" with a close button to the flash message.


To show messages on view files, use the following:

```html
@include('flash::message')
```

If you need to modify the flash message, you can run:

```bash
php artisan vendor:publish --provider="Laracasts\Flash\FlashServiceProvider"
```
