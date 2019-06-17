# HTML minifier
## Introduction

Very, very simple html minifier with Laravel 5.x support.

It _minifies_ HTML by

1. removing HTML comments except IE conditions
2. removing comments
3. shorten multiple white spaces
4. removing whitespaces between HTML tags
5. collapsing new lines
 
You should end up with a small size profit:

| Uniminfied | Minified |
|------------|----------|
| 64.2KB     | 44.6KB   |

## Code Samples

```php
$input = "<a href="/foo" class="bar  moo        ">Hello World</a>";
$minifier = new Minifier();
$output = $minifier->html($string); // <a href="/foo" class="bar moo ">Hello World</a>
```

## Installation

You can install the package via composer:

``` bash
composer require eolme/laravel-minify-html
```
If you are using Laravel you can add the middleware to your middleware providers

```php
// app/Http/Kernel.php
/**
 * The application's global HTTP middleware stack.
 *
 * @var array
 */
protected $middleware = [
    ...
    \Eolme\Minify\Middleware\MinifyResponse::class,
];
```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT).
