# Pseudolocale

[![Packagist](https://img.shields.io/packagist/v/arokettu/pseudolocale.svg?style=flat-square)](https://packagist.org/packages/sandfoxme/torrent-file)
[![Packagist](https://img.shields.io/packagist/l/arokettu/pseudolocale.svg?style=flat-square)](https://opensource.org/licenses/MIT)
[![Gitlab pipeline status](https://img.shields.io/gitlab/pipeline/sandfox/php-pseudolocale/master.svg?style=flat-square)](https://gitlab.com/sandfox/php-pseudolocale/-/pipelines)

Generates pseudo localization strings.

## Installation

```bash
composer require arokettu/pseudolocale
```

## Example

```php
<?php

echo \Arokettu\Pseudolocale\Pseudolocale::pseudolocalize(
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
); // [-- Løгєო ıρšūო ðø∤øг šıτ åოєτ, çøπšєçτєτūг åðıρıšçıπց є∤ıτ, šєð ðø єıūšოøð τєოρøг ıπçıðıðūπτ ūτ ∤åЬøгє єτ ðø∤øгє ოåցπå å∤ıզūå. --]
```

## Documentation

Read full documentation here: <https://sandfox.dev/php/pseudolocale.html>

Also on Read the Docs: <https://php-pseudolocale.readthedocs.io/>

## Support

Please file issues on our main repo at GitLab: <https://gitlab.com/sandfox/php-pseudolocale/-/issues>

## License

The library is available as open source under the terms of the [MIT License].

[MIT License]:  https://opensource.org/licenses/MIT
