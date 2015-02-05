<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests\helpers;

use axy\phpcode\phpdoc\helpers\Normalizer;

/**
 * coversDefaultClass axy\phpcode\phpdoc\helpers\Normalizer
 */
class NormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::toLines
     * @dataProvider providerToLines
     * @param string $block
     * @param array $expected
     */
    public function testToLines($block, $expected)
    {
        $this->assertEquals($expected, Normalizer::toLines($block));
    }

    /**
     * @return array
     */
    public function providerToLines()
    {
        return [
            [
                trim(file_get_contents(__DIR__.'/tst/full.txt')),
                [
                    'This is title of the block',
                    '',
                    'This is description.',
                    'Multiline and contains inline tags ({@see example}).',
                    '',
                    '@param int $one',
                    '       a first argument',
                    '@param (int|string) $two [optional]',
                    '       a second argument',
                    '@return int',
                    '        the result',
                ],
            ],
            [
                '/** @source */',
                [
                    '@source',
                ],
            ],
        ];
    }

    /**
     * covers ::shiftToLeft
     * @dataProvider providerShiftToLeft
     * @param array $lines
     * @param array $expected
     */
    public function testShiftToLeft($lines, $expected)
    {
        $this->assertEquals($expected, Normalizer::shiftToLeft($lines));
    }

    /**
     * @return array
     */
    public function providerShiftToLeft()
    {
        return [
            [
                [
                    'one',
                    '',
                    '  two',
                ],
                [
                    'one',
                    '',
                    '  two',
                ],
            ],
            [
                [
                    '  one',
                    '',
                    '    two',
                ],
                [
                    'one',
                    '',
                    '  two',
                ],
            ],
        ];
    }

    /**
     * covers ::trimLines
     * covers ::trimLinesBegin
     * covers ::trimLinesEnd
     */
    public function testTrimLines()
    {
        $lines = [
            '',
            '',
            '  ',
            ' one',
            '',
            'two',
            'three ',
            ' ',
            '',
        ];
        $expectedBegin = [
            '  ',
            ' one',
            '',
            'two',
            'three ',
            ' ',
            '',
        ];
        $expectedEnd = [
            '',
            '',
            '  ',
            ' one',
            '',
            'two',
            'three ',
            ' ',
        ];
        $expectedFull = [
            '  ',
            ' one',
            '',
            'two',
            'three ',
            ' ',
        ];
        $this->assertEquals($expectedBegin, Normalizer::trimLinesBegin($lines));
        $this->assertEquals($expectedEnd, Normalizer::trimLinesEnd($lines));
        $this->assertEquals($expectedFull, Normalizer::trimLines($lines));
        $this->assertEquals([], Normalizer::trimLinesBegin(['', '', '']));
        $this->assertEquals([], Normalizer::trimLinesEnd(['', '', '']));
        $this->assertEquals([], Normalizer::trimLines(['', '', '']));
    }
}
