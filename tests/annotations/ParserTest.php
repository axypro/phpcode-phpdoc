<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\Parser;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\Parser
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::parseAnnotationBlock
     */
    public function testParseAnnotationBlock()
    {
        $block = [
            'Text',
            '@my\Annotation(x=1)',
            '',
            '@param string $x [optional]',
            '       a first argument',
            '@param int $y',
            '       a second argument',
            '',
            '@return int the result',
            '',
        ];
        $blanks = Parser::parseAnnotationBlock($block);
        $expectedList = [
            [
                'tag' => 'my\Annotation',
                'data' => 'x=1',
                'text' => '',
            ],
            [
                'tag' => 'param',
                'data' => null,
                'text' => "string \$x [optional]\n       a first argument",
            ],            [
                'tag' => 'param',
                'data' => null,
                'text' => "int \$y\n       a second argument",
            ],
            [
                'tag' => 'return',
                'data' => null,
                'text' => 'int the result',
            ],
        ];
        $this->assertInternalType('array', $blanks);
        $this->assertCount(count($expectedList), $blanks);
        foreach ($expectedList as $i => $expected) {
            $this->assertArrayHasKey($i, $blanks);
            $blank = $blanks[$i];
            $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\Blank', $blank);
            $this->assertEquals($expected, (array)$blank);
        }
        $block2 = ['Text'];
        $this->assertEmpty(Parser::parseAnnotationBlock($block2));
    }
}
