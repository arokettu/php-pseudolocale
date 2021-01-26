<?php

declare(strict_types=1);

namespace Arokettu\Pseudolocale\Tests;

use Arokettu\Pseudolocale\Pseudolocale;
use PHPUnit\Framework\TestCase;

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
}
