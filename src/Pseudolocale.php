<?php

declare(strict_types=1);

namespace Arokettu\Pseudolocale;

use InvalidArgumentException;

final class Pseudolocale
{
    public const REPLACE_LOWERCASE = 0b0001;
    public const REPLACE_UPPERCASE = 0b0010;
    public const REPLACE_ALL = self::REPLACE_LOWERCASE | self::REPLACE_UPPERCASE;

    public const FORMAT_STRINGS =
        /** @lang RegExp */
        '/%(?:\d+\$)?(?:[-+ 0]|(?:\'.))?\d*(?:\.\d+)?[bcdeEfFgGhHosuxX]/';

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

    private const REPLACER_BASE = '~!@#$^&*()_+'; // not likely to be encountered in any translatable string

    public static function pseudolocalize(
        string $string,
        int $mode = self::REPLACE_ALL,
        string $prefix = '[-- ',
        string $postfix = ' --]',
        ?string $regexPreserve = self::FORMAT_STRINGS
    ): string {
        $matchesCount = 0;
        $matches = [[]];

        // find all substrings to preserve
        if ($regexPreserve !== null) {
            $matchesCount = preg_match_all($regexPreserve, $string, $matches);

            if ($matchesCount === false) {
                throw new InvalidArgumentException(sprintf('Probably invalid regex: "%s"', $regexPreserve));
            }
        }

        // return early if nothing to preserve
        if ($matchesCount === 0) {
            $string = self::doReplacements($string, $mode);
            return $prefix . $string . $postfix;
        }

        // if we need something to preserve
        if ($matchesCount > 0) {
            $replacer = self::REPLACER_BASE;

            while (strpos($string, $replacer) !== false) {
                // grow replacer until it is not contained in the string
                // randomize the growth to avoid patterns
                $replacer .= str_shuffle($replacer);
            }

            // replace the patterns to be preserved with placeholder
            // phpcs:ignore PHPCS_SecurityAudit.BadFunctions.PregReplace.PregReplaceDyn
            $string = preg_replace($regexPreserve, $replacer, $string);

            // do the replacements
            $string = self::doReplacements($string, $mode);

            // escape percent and add string params
            $string = str_replace(['%', $replacer], ['%%', '%s'], $string);
            $string = sprintf($string, ...$matches[0]);
        }

        // add prefix and postfix
        return $prefix . $string . $postfix;
    }

    private static function doReplacements(string $string, int $mode = self::REPLACE_ALL): string
    {
        if ($mode & self::REPLACE_LOWERCASE) {
            $string = str_replace(self::LATIN_LOWERCASE_LETTERS, self::LATIN_LOWERCASE_REPLACEMENTS, $string);
        }

        if ($mode & self::REPLACE_UPPERCASE) {
            $string = str_replace(self::LATIN_UPPERCASE_LETTERS, self::LATIN_UPPERCASE_REPLACEMENTS, $string);
        }

        return $string;
    }
}
