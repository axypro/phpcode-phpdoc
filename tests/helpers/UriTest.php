<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests\helpers;

use axy\phpcode\phpdoc\helpers\Uri;

/**
 * coversDefaultClass axy\phpcode\phpdoc\helpers\Uri
 */
class UriTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::isURI
     * @dataProvider providerIsURI
     * @param string $string
     * @param bool $expected
     */
    public function testIsURI($string, $expected)
    {
        $this->assertSame($expected, Uri::isURI($string));
    }

    /**
     * @return array
     */
    public function providerIsURI()
    {
        return [
            ['http://example.com/', true],
            ['https://example.com/', true],
            ['hTTp://example.com/', true],
            ['ftp://example.com/', true],
            ['file:///example.com/', true],
            ['//example.com/', true],
            ['/var/www/file.txt', false],
            ['', false],
            ['This is text', false],
        ];
    }
}
