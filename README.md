# J2Store Source for YOOtheme Pro

A [YOOtheme Pro](https://yootheme.com/page-builder) Source for the Joomla Component [J2Store](https://j2commerce.com).

## Getting Started

The J2Store Source is a YOOtheme Pro module ready to be set in a Child Theme or wrapped into a plugin. Assuming the Child Theme is the prefered choice follow these steps for the initial setup:

1. Create a folder `yootheme_mytheme` or with a sufix of your choice.
1. Enable the new Child Theme in the YOOtheme Pro Customizer `Advanced Settings`.
1. Place the contents of this repository into `yootheme_mytheme/modules/builder-source-j2store`.
1. Create a `yootheme_mytheme/config.php` file with the following content:

```php
<?php

use function YOOtheme\app;

app()->load(__DIR__ . '/modules/*/bootstrap.php');

return [];
```

## Requirements

- PHP 7.2+
- Joomla 4.0+
- YOOtheme Pro 4.4+
- J2Store 4.0+

## Mentions

Developed and maintained by [ZOOlanders](https://www.zoolanders.com).
