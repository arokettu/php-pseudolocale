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
    echo Pseudolocale::pseudolocalize($text, Pseudolocale::REPLACE_LOWERCASE);
    // [-- TႬє Qūıçк Bгøψπ Føχ Jūოρš Oνєг TႬє Låẑγ Døց --]

    // Replace only uppercase letters:
    echo Pseudolocale::pseudolocalize($text, Pseudolocale::REPLACE_UPPERCASE);
    // [-- Ⱦhe Ⴍuick ßrown Ғox Ʝumps Øver Ⱦhe Łazy Ðog --]

    // Redefine prefix and postfix:
    echo Pseudolocale::pseudolocalize($text, Pseudolocale::REPLACE_ALL, '<', '>');
    // or better, use new PHP 8 syntax:
    echo Pseudolocale::pseudolocalize($text, prefix: '<', postfix: '>');
    // <ȾႬє Ⴍūıçк ßгøψπ Ғøχ Ʝūოρš Øνєг ȾႬє Łåẑγ Ðøց>

    // Since 1.1 the library does not replace sprintf replacement patterns by default:
    echo Pseudolocale::pseudolocalize("It's %d to go alone. Take %s with you");
    // [-- エτ'š %d τø ցø å∤øπє. Ⱦåкє %s ψıτႬ γøū --]
    // You can use your own patterns
    echo Pseudolocale::pseudolocalize(
        'No, %username%! I am your %relative%!',
        Pseudolocale::REPLACE_ALL,
        '[-- ', ' --]',
        '/%\w+%/'
    );
    // PHP 8 is preferred:
    echo Pseudolocale::pseudolocalize('No, %username%! I am your %relative%!', regexPreserve: '/%\w+%/');
    // [-- Ñø, %username%! エ åო γøūг %relative%! --]
