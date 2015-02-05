<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\Blank
 */
class BlankTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::seekInLine
     * @dataProvider providerSeekInLine
     * @param string $line
     * @param array|null $expected
     */
    public function testSeekInLine($line, $expected)
    {
        $blank = Blank::seekInLine($line);
        if ($expected === null) {
            $this->assertNull($blank);
        } else {
            $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\Blank', $blank);
            $this->assertEquals($expected, (array)$blank);
        }
    }

    /**
     * @return array
     */
    public function providerSeekInLine()
    {
        return [
            [
                '',
                null,
            ],
            [
                'Text',
                null,
            ],
            [
                'Text @link',
                null,
            ],
            [
                ' @link',
                null,
            ],
            [
                '@source',
                [
                    'tag' => 'source',
                    'data' => null,
                    'text' => '',
                ],
            ],
            [
                '@param string $x [optional]',
                [
                    'tag' => 'param',
                    'data' => null,
                    'text' => 'string $x [optional]',
                ],
            ],
            [
                '@property-read string $prop description',
                [
                    'tag' => 'property-read',
                    'data' => null,
                    'text' => 'string $prop description',
                ],
            ],
            [
                '@my\Annotation(x=1;y=2) text ',
                [
                    'tag' => 'my\Annotation',
                    'data' => 'x=1;y=2',
                    'text' => 'text',
                ],
            ],
            [
                '{@see}',
                null,
            ],
            [
                '{@inheritdoc}',
                [
                    'tag' => 'inheritdoc',
                    'data' => null,
                    'text' => '',
                ],
            ],
            [
                '{@inheritdoc} ok',
                [
                    'tag' => 'inheritdoc',
                    'data' => null,
                    'text' => 'ok',
                ],
            ],
        ];
    }

    /**
     * covers ::appendLine
     */
    public function testAppendLine()
    {
        $blank = new Blank('tag', 'one');
        $blank->appendLine('  two');
        $blank->appendLine('');
        $blank->appendLine('three');
        $blank->appendLine('');
        $blank->appendLine('');
        $this->assertSame("one\n  two\n\nthree\n\n", $blank->text);
        $blank->stop();
        $this->assertSame("one\n  two\n\nthree", $blank->text);
    }
}
