Pseudolocale
############

|Packagist| |GitLab| |GitHub| |Bitbucket| |Gitea|

The library is used to generate readable strings for ASCII latin to test Unicode support and/or detect missing translation strings.
The result is a mix of extended latin, cyrillic, greek, armenian, georgian, japanese scripts with some math symbols.

Installation
============

Install by composer

.. code-block:: bash

    composer require arokettu/pseudolocale

Examples
========

.. code-block:: php

    <?php

    use Arokettu\Pseudolocale\Pseudolocale;

    $text = 'The Quick Brown Fox Jumps Over The Lazy Dog';

    // Lowercase letters:
    echo Pseudolocale::pseudolocalize(strtolower($text));
    // [-- τႬє զūıçк Ьгøψπ ⨍øχ ʝūოρš øνєг τႬє ∤åẑγ ðøց --]

    // Uppercase letters:
    echo Pseudolocale::pseudolocalize(strtoupper($text));
    // [-- ȾҢЁ ႭՄエζҚ ßЯØЩÑ ҒØΧ ꞲՄṀРႽ ØѴЁЯ ȾҢЁ ŁÅẐჄ ÐØႺ --]

    // Replace only lowercase letters:
    echo Pseudolocale::pseudolocalize(strtoupper($text), Pseudolocale::REPLACE_LOWERCASE);
    // [-- TႬє Qūıçк Bгøψπ Føχ Jūოρš Oνєг TႬє Låẑγ Døց --]

    // Replace only uppercase letters:
    echo Pseudolocale::pseudolocalize(strtoupper($text), Pseudolocale::REPLACE_UPPERCASE);
    // [-- Ⱦhe Ⴍuick ßrown Ғox Ʝumps Øver Ⱦhe Łazy Ðog --]

    // Redefine prefix and postfix:
    echo Pseudolocale::pseudolocalize($text, Pseudolocale::REPLACE_ALL, '<', '>');
    // or better, use new PHP 8 syntax:
    echo Pseudolocale::pseudolocalize($text, prefix: '<', postfix: '>');
    // <ȾႬє Ⴍūıçк ßгøψπ Ғøχ Ʝūოρš Øνєг ȾႬє Łåẑγ Ðøց>

License
=======

The library is available as open source under the terms of the `MIT License`_.
See LICENSE.md

.. _MIT License: https://opensource.org/licenses/MIT

.. |Packagist|  image:: https://img.shields.io/packagist/v/arokettu/pseudolocale.svg?style=flat-square
   :target:     https://packagist.org/packages/arokettu/pseudolocale
.. |GitHub|     image:: https://img.shields.io/badge/get%20on-GitHub-informational.svg?style=flat-square&logo=github
   :target:     https://github.com/arokettu/php-pseudolocale
.. |GitLab|     image:: https://img.shields.io/badge/get%20on-GitLab-informational.svg?style=flat-square&logo=gitlab
   :target:     https://gitlab.com/sandfox/php-pseudolocale
.. |Bitbucket|  image:: https://img.shields.io/badge/get%20on-Bitbucket-informational.svg?style=flat-square&logo=bitbucket
   :target:     https://bitbucket.org/sandfox/php-pseudolocale
.. |Gitea|      image:: https://img.shields.io/badge/get%20on-Gitea-informational.svg?style=flat-square&logo=gitea
   :target:     https://sandfox.org/sandfox/php-pseudolocale
