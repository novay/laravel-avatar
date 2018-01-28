# Laravel Avatar

[![Total Downloads](https://poser.pugx.org/novay/laravel-avatar/d/total.svg)](https://packagist.org/packages/novay/laravel-avatar)
[![Build Status](https://secure.travis-ci.org/novay/laravel-avatar.png?branch=master)](http://travis-ci.org/novay/laravel-avatar)
[![Latest Stable Version](https://poser.pugx.org/novay/laravel-avatar/v/stable.svg)](https://packagist.org/packages/novay/laravel-avatar)
[![Latest Unstable Version](https://poser.pugx.org/novay/laravel-avatar/v/unstable.svg)](https://packagist.org/packages/novay/laravel-avatar)
[![License](https://poser.pugx.org/novay/laravel-avatar/license.svg)](https://raw.githubusercontent.com/novay/laravel-auth/LICENSE)

Laravel package to display unique avatar for any user based on their (initials) name.

- [About](#about)
- [Requirements](#requirements)
- [Installation](#installation)
    - [Laravel 5.5 and above](#laravel-5-5-and-above)
    - [Only for Laravel 5.2, 5.3, 5.4](#only-for-laravel-5-2-5-3-5-4)
    - [Publish Config (Optional)](#publish-config-optional)
- [Basic Usage](#basic-usage)
- [Advanced Usage](#advanced-usage)
    - [Save As File](#save-as-file)
    - [Output As SVG](#output-as-svg)
    - [Get Underlying Intervention image object](#get-underlying-intervention-image-object)
    - [Non-ASCII Character](#non-ascii-character)
    - [Overriding config at runtime](#overriding-config-at-runtime)
    - [Integration With Other PHP Project](#integration-with-other-php-project)
- [Credits](#credits)
- [License](#license)

### About
This package originally built for Laravel, but can also be used in any PHP project.

[Read more about integration with PHP project here.](#integration-with-other-php-project)

### Requirements
* [Laravel 5.2, 5.3, 5.4 or newer](https://laravel.com/docs/installation)

### Installation

##### Laravel 5.5 and above
1. From your projects root folder in terminal run:

```bash
    composer require novay/laravel-uuid
```

* Uses package auto discovery feature, no need to edit the `config/app.php` file.

##### Only for Laravel 5.2, 5.3, 5.4
2. Register the package with laravel in `config/app.php` under `providers` and `aliases` with the following:

``` php
// Providers
Novay\Avatar\ServiceProvider::class,

...

// Aliases
'Avatar'    => Novay\Avatar\Facade::class,
```

##### Publish Config (Optional)

``` php
php artisan vendor:publish --provider="Novay\Avatar\ServiceProvider"
```
This will create config file located in `config/novay/laravel-avatar.php`.

### Basic Usage

To quickly generate a Avatar just do

```php
//this will output data-uri (base64 image data)
//something like data:image/png;base64,iVBORw0KGg....
Avatar::create('Joko Widodo')->toBase64();

//use in view
//this will display initials JW as an image
<img src="{{ Avatar::create('Joko Widodo')->toBase64() }}" />
```

### Advanced Usage

#### Save As File

```php
Avatar::create('Susilo Bambang Yudhoyono')->save('sample.png');
Avatar::create('Susilo Bambang Yudhoyono')->save('sample.jpg', 100); // quality = 100
```

#### Output As SVG

```php
Avatar::create('Susilo Bambang Yudhoyono')->toSvg();
```

#### Get Underlying Intervention image object

```php
Avatar::create('Raisa Maulida')->getImageObject();
```

The method will return an instance of [Intervention image object](http://image.intervention.io/), so you can use it for further purposes.

#### Non-ASCII Character
By default, this package will try to output any initials letter as it is. If the name supplied contains any non-ASCII character (e.g. ā, Ě, ǽ) then the result will depend on which font used (see config). It the font supports characters supplied, it will successfully displayed, otherwise it will not.

Alternatively, we can convert all non-ascii to their closest ASCII counterparts. If no closest coutnerparts found, those characters are removed. Thanks to [Stringy](https://github.com/danielstjules/Stringy) for providing such useful functions. What we need is just change one line in `config/laravel-avatar.php`:

``` php
    'ascii'    => true,
```

#### Overriding config at runtime
We can overriding configuration at runtime by using following functions:

``` php
Avatar::create('Soekarno')->setDimension(100);//width = height = 100 pixel
Avatar::create('Soekarno')->setDimension(100, 200); // width = 100, height = 200
Avatar::create('Soekarno')->setBackground('#001122');
Avatar::create('Soekarno')->setForeground('#999999');
Avatar::create('Soekarno')->setFontSize(72);
Avatar::create('Soekarno')->setFont('/path/to/font.ttf');
Avatar::create('Soekarno')->setBorder(1, '#aabbcc'); // size = 1, color = #aabbcc
Avatar::create('Soekarno')->setShape('square');

// Chaining
Avatar::create('Habibie')->setDimension(50)->setFontSize(18)->toBase64();

``` 

#### Integration With Other PHP Project

```php
// include composer autoload
require 'vendor/autoload.php';

// import the Avatar class
use Novay\Avatar\Avatar;

// create your first avatar
$avatar = new Avatar($config);
$avatar->create('John Doe')->toBase64();
$avatar->create('John Doe')->save('path/to/file.png', $quality = 90);
```
`$config` is just an ordinary array with same format as explained above (See [Configuration](#configuration)).

### Credits
* Full development credit must go to [laravolt](https://github.com/laravolt). This package was taken to be compliant with [MIT](https://opensource.org/licenses/MIT) licensing standards for production use.

## License
Laravel UUID is licensed under the MIT license for both personal and commercial products. Enjoy!