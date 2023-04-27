Locator
-------

[![Latest Stable Version](https://poser.pugx.org/douyasi/locator/v/stable.svg?format=flat-square)](https://packagist.org/packages/douyasi/locator)
[![Latest Unstable Version](https://poser.pugx.org/douyasi/locator/v/unstable.svg?format=flat-square)](https://packagist.org/packages/douyasi/locator)
[![License](https://poser.pugx.org/douyasi/locator/license?format=flat-square)](https://packagist.org/packages/douyasi/locator)
[![Total Downloads](https://poser.pugx.org/douyasi/locator/downloads?format=flat-square)](https://packagist.org/packages/douyasi/locator)



### Description

Browser Preferred Language Detector, detect by browser `Accept-Language` request header.

### Installation

Get [Composer](https://getcomposer.org/), then run in terminal:

```bash
cd /path/to/your-project
composer require "douyasi/locator:~1.0"
```

### Usage

Here is an example in Laravel:

```php
Route::get('test', function () {
    $detector = app('Douyasi\Locator\PreferredLanguageDetector');
    return $detector->detect(['zh-CN', 'en']);
    //return $detector->get();
    //return $detector->get_languages(['zh-CN,zh', 'en', 'zh-TW'], ['0.8', '0.6', '0.4']);
});
```

>   You can use `$detector->detect(['zh-CN', 'en'])` to replace `Request::getPreferredLanguage(['zh-CN', 'en'])` in Laravel.

### API

#### Detect your browser preferred language:

```
$langs = ['zh-CN', 'en'];  //available languages (i18n array) in your web project
$detector->detect($langs);  //return 'zh-CN' or 'en', according to your browser language preference.
```

#### Get browser preferred languages:

```
$detector->get();
```

You can get some data (json format) like blow:

```json
[
    {
        "priority": 80,
        "tags": "zh-CN,zh",
        "locales": [
            {
                "language": "zh",
                "region": "CN",
                "script": "",
                "variant1": "",
                "variant2": "",
                "variant3": "",
                "private1": "",
                "private2": "",
                "private3": ""
            },
            {
                "language": "zh",
                "script": "",
                "region": "",
                "variant1": "",
                "variant2": "",
                "variant3": "",
                "private1": "",
                "private2": "",
                "private3": ""
            }
        ]
    },
    {
        "priority": 60,
        "tags": "en",
        "locales": [
            {
                "language": "en",
                "script": "",
                "region": "",
                "variant1": "",
                "variant2": "",
                "variant3": "",
                "private1": "",
                "private2": "",
                "private3": ""
            }
        ]
    }
]
```

### Reference

* [http-accept-language](https://github.com/BaguettePHP/http-accept-language)

### License

> MIT
> Copyright (c) 2016 [douyasi](http://douyasi.com) org by ycrao

### Special Thanks

![JetBrains Logo (Main) logo](https://resources.jetbrains.com/storage/products/company/brand/logos/jb_beam.svg)
