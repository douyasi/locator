Locator
=======

Description
-----------

Browser Preferred Language Detector by browser `Accept-Language` request header.

Installation
------------

Get [Composer](https://getcomposer.org/), then run in terminal:

```bash
cd /path/to/your-project
composer require 'douyasi/locator: ~1.0'
```

Usage
-----

### Example in Laravel

```php
Route::get('test', function () {
    $detector = app('Douyasi\Locator\PreferredLanguageDetector');
    return $detector->detect(['zh-CN', 'en']);
    //return $detector->get();
    //return $detector->get_languages(['zh-CN,zh', 'en', 'zh-TW'], ['0.8', '0.6', '0.4']);
});
```


>   You can use `$detector->detect(['zh-CN', 'en'])` to replace `Request::getPreferredLanguage(['zh-CN', 'en'])` in Laravel.

API
---

### Detect your browser preferred language:

```
$langs = ['zh-CN', 'en'];  //available languages (i18n array) in your web project
$detector->detect($langs);  //return 'zh-CN' or 'en', according to your browser language preference.
```

### Get browser preferrend languages:

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
    },
]
```

Reference
---------

 * [http-accept-language](https://github.com/BaguettePHP/http-accept-language)

Copyright
---------

> http://douyasi.com
>
> Copyright (c) 2016 douyasi org by ycrao
