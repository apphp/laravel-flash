# Simple Flash Messages for Laravel Framework Applications

This package allows to use Bootstrap 3/4 flash messaging for Laravel 6+ framework applications.

## Requirements

* php >=7.0
* Laravel 6+

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

| method                                    | description                                                                   |
|-------------------------------------------|-------------------------------------------------------------------------------|
| `flash('your-message', 'primary')`        | Set the flash type to "primary".                                              |
| `flash('your-message', 'secondary')`      | Set the flash type to "secondary".                                            |
| `flash('your-message', 'success')`        | Set the flash type to "success".                                              |
| `flash('your-message', 'danger')`         | Set the flash type to "error".                                                |
| `flash('your-message', 'error')`          | Set the flash type to "error" (alias to "danger").                            |
| `flash('your-message', 'warning')`        | Set the flash type to "error".                                                |
| `flash('your-message', 'error')`          | Set the flash type to "error" without a close button to the flash message.    |
| `flash('your-message', 'error', true)`    | Set the flash type to "error" with a close button to the flash message.       |

You may also use facade directly:
```php
use Apphp\Flash\Flash;
```

| method                                    | description                                                                   |
|-------------------------------------------|-------------------------------------------------------------------------------|
| `Flash::success('your-message')`          | Set the success flash message.                                                |
| `Flash::error('your-message')`            | Set the flash type to "error" without a close button to the flash message.    |
| `Flash::error('your-message', true)`      | Set the flash type to "error" with a close button to the flash message.       |
etc.


To show messages on view files, use the following:

```html
@include('flash::message')
```

If you need to modify the flash message, you can run:

```bash
php artisan vendor:publish --provider="Apphp\Flash\FlashServiceProvider"
```

## Show Multiple Messages

If you need to flash multiple flash messages, you may simply define them one after another.

```php
flash('First Message', 'success');
flash('Second Message', 'warning', true);

return redirect('somewhere');
```

Take in account, that you'll not see flash messages if you don't perform redirect.

## Clear Messages

If you need to clear flash messages, you may do it in the following way:

```php
// All previously defined messages will be removed
flash('First Message', 'error');
flash('Second Message', 'danger')->clear();

// All previously defined messages will be removed
flash('First Message', 'error');
flash('Second Message', 'danger');
Flash::success('Third Message');
flash()->clear();

Flash::success('First Message');
// Only current message will be removed
Flash::error('Second Message')->clear();

return redirect('somewhere');
```

## License

This project is released under the MIT License.   
Copyright © 2020 [ApPHP](https://www.apphp.com/).
