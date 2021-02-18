<?php

declare(strict_types=1);

namespace Arokettu\Pseudolocale\Tests;

use Arokettu\Pseudolocale\Pseudolocale;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class PseudolocaleTest extends TestCase
{
    private const STRING = 'The Quick Brown Fox Jumps Over The Lazy Dog';

    public function testSimpleCall()
    {
        self::assertEquals(
            '[-- ȾႬє Ⴍūıçк ßгøψπ Ғøχ Ʝūოρš Øνєг ȾႬє Łåẑγ Ðøց --]',
            Pseudolocale::pseudolocalize(self::STRING)
        );
    }

    public function testLowercase()
    {
        self::assertEquals(
            '[-- TႬє Qūıçк Bгøψπ Føχ Jūოρš Oνєг TႬє Låẑγ Døց --]',
            Pseudolocale::pseudolocalize(self::STRING, Pseudolocale::REPLACE_LOWERCASE)
        );
    }

    public function testUppercase()
    {
        self::assertEquals(
            '[-- Ⱦhe Ⴍuick ßrown Ғox Ʝumps Øver Ⱦhe Łazy Ðog --]',
            Pseudolocale::pseudolocalize(self::STRING, Pseudolocale::REPLACE_UPPERCASE)
        );
    }

    public function testPrefixPostfix()
    {
        self::assertEquals(
            '<ȾႬє Ⴍūıçк ßгøψπ Ғøχ Ʝūოρš Øνєг ȾႬє Łåẑγ Ðøց>',
            Pseudolocale::pseudolocalize(self::STRING, Pseudolocale::REPLACE_ALL, '<', '>')
        );
    }

    public function testNonAscii()
    {
        // non ascii and non letters are not replaced
        $string = '133 ťéşť тест δοκιμή';

        self::assertEquals(
            $string,
            Pseudolocale::pseudolocalize($string, Pseudolocale::REPLACE_ALL, '', '')
        );
    }

    public function testPreserveFormatStrings()
    {
        $string   = 'The %1$g brown %f jumps over the lazy %5.2d';
        $expected = 'ȾႬє %1$g Ьгøψπ %f ʝūოρš øνєг τႬє ∤åẑγ %5.2d';

        self::assertEquals(
            $expected,
            Pseudolocale::pseudolocalize($string, Pseudolocale::REPLACE_ALL, '', '')
        );

        $string   = "AAAbbbccc%2$'w14sghfdghsjk543%1$12.4dbashf";
        $expected = "ÅÅÅЬЬЬççç%2$'w14sցႬ⨍ðցႬšʝк543%1$12.4dЬåšႬ⨍";

        self::assertEquals(
            $expected,
            ($string = Pseudolocale::pseudolocalize($string, Pseudolocale::REPLACE_ALL, '', ''))
        );

        // pass the previous string through sprintf
        $string   = sprintf($string, 64, 'str');
        $expected = 'ÅÅÅЬЬЬçççwwwwwwwwwwwstrցႬ⨍ðցႬšʝк543          64ЬåšႬ⨍';

        self::assertEquals($expected, $string);
    }

    public function testPreserveOtherPatterns()
    {
        // marker style
        $string   = 'The quick brown %vulpine% jumps over the lazy %canine%';
        $expected = 'ȾႬє զūıçк Ьгøψπ %vulpine% ʝūოρš øνєг τႬє ∤åẑγ %canine%';

        self::assertEquals(
            $expected,
            Pseudolocale::pseudolocalize($string, Pseudolocale::REPLACE_ALL, '', '', '/%\w+%/')
        );

        // ruby substitution style
        $string   = 'The quick brown #{vulpine} jumps over the lazy #{canine}';
        $expected = 'ȾႬє զūıçк Ьгøψπ #{vulpine} ʝūოρš øνєг τႬє ∤åẑγ #{canine}';

        self::assertEquals(
            $expected,
            Pseudolocale::pseudolocalize($string, Pseudolocale::REPLACE_ALL, '', '', '/#{\w+}/')
        );
    }

    public function testInvalidRegex()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Probably invalid regex: /--');

        @Pseudolocale::pseudolocalize('', 0, '', '', '/--');
    }

    public function testReplacerConflict()
    {
        self::assertEquals(
            '[-- τєšτ ~!@#$^&*()_+ %d ~!@#$^&*()_+ %s ~!@#$^&*()_+ τєšτ --]',
            Pseudolocale::pseudolocalize('test ~!@#$^&*()_+ %d ~!@#$^&*()_+ %s ~!@#$^&*()_+ test')
        );
    }
}
