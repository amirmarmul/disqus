Laravel - Disqus Integration
==========
[![Latest Stable Version](https://poser.pugx.org/kcdev/disqus/v/stable)](https://packagist.org/packages/kcdev/disqus)
[![Total Downloads](https://poser.pugx.org/kcdev/disqus/downloads)](https://packagist.org/packages/kcdev/disqus)
[![License](https://poser.pugx.org/kcdev/disqus/license)](https://packagist.org/packages/kcdev/disqus)

Integrating your application with Disqus platform.

# Installation
Via composer
```
composer require kcdev/disqus
```

### Setup

In `app/config/app.php` add the following :

- The ServiceProvider to the providers array :

```php
Kcdev\Disqus\DisqusServiceProvider::class,
```

- The class alias to the aliases array :

```php
'Disqus' => Kcdev\Disqus\Facades\Disqus::class,
```

- Publish the config file

```ssh
php artisan vendor:publish --provider="Kcdev\Disqus\DisqusServiceProvider"
```

### Configuration

Add `DISQUS_USERNAME` in **.env** file :

```
DISQUS_USERNAME=your_disqus_user_name
```

(You can obtain them from [here](https://www.disqus.com))

### Usage

Display disqus form :

```php
{!! Disqus::display() !!}
```

With [custom config](https://help.disqus.com/developer/javascript-configuration-variables) (page.url and page.identifier) :

```php
{!! Disqus::display(['data-url' => 'http://some.url/request', 'data-identifier' => 'your.identifier.id']) !!}
```

## Without Laravel

Checkout example below:

```php
<?php

require_once "vendor/autoload.php";

$username  = 'your_disqus_username';
$disqus = new \Kcdev\Disqus\Disqus($username);

?>
<body>
    <?php echo $disqus->display(); ?>
</body>
```

## Security Vulnerabilities

If you discover a security vulnerability within our library, please send an e-mail to Amiruddin Marmul via [amiruddinmarmul@gmail.com](mailto:amiruddinmarmul@gmail.com). All security vulnerabilities will be promptly addressed.

## License

Lavavel - Disqus Integration is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).