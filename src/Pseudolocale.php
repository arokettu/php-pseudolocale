<?php

declare(strict_types=1);

namespace Arokettu\Pseudolocale;

final class Pseudolocale
{
    public const REPLACE_LOWERCASE = 0b0001;
    public const REPLACE_UPPERCASE = 0b0010;
    public const REPLACE_ALL = self::REPLACE_LOWERCASE | self::REPLACE_UPPERCASE;

    private const LATIN_LOWERCASE_LETTERS = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    ];
    private const LATIN_LOWERCASE_REPLACEMENTS = [
        'å', 'Ь', 'ç', 'ð', 'є', '⨍', 'ց', 'Ⴌ', 'ı', 'ʝ', 'к', '∤', 'ო',
        'π', 'ø', 'ρ', 'զ', 'г', 'š', 'τ', 'ū', 'ν', 'ψ', 'χ', 'γ', 'ẑ',
    ];
    private const LATIN_UPPERCASE_LETTERS = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
    ];
    private const LATIN_UPPERCASE_REPLACEMENTS = [
        'Å', 'ß', 'ζ', 'Ð', 'Ё', 'Ғ', 'Ⴚ', 'Ң', 'エ', 'Ʝ', 'Қ', 'Ł', 'Ṁ',
        'Ñ', 'Ø', 'Р', 'Ⴍ', 'Я', 'Ⴝ', 'Ⱦ', 'Մ', 'Ѵ', 'Щ', 'Χ', 'Ⴤ', 'Ẑ',
    ];

    public static function pseudolocalize(
        string $string,
        int $mode = self::REPLACE_ALL,
        string $prefix = '[-- ',
        string $postfix = ' --]'
    ): string {
        if ($mode & self::REPLACE_LOWERCASE) {
            $string = str_replace(self::LATIN_LOWERCASE_LETTERS, self::LATIN_LOWERCASE_REPLACEMENTS, $string);
        }

        if ($mode & self::REPLACE_UPPERCASE) {
            $string = str_replace(self::LATIN_UPPERCASE_LETTERS, self::LATIN_UPPERCASE_REPLACEMENTS, $string);
        }

        return $prefix . $string . $postfix;
    }
}
