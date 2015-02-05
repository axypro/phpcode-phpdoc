<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\TagReturn;
use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\TagReturn
 */
class TagReturnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getTypes
     * covers ::getDescription
     * @dataProvider providerTag
     * @param string $line
     * @param string $types
     * @param string $description
     * @param bool $exception [optional]
     */
    public function testTag($line, $types, $description, $exception = false)
    {
        $blank = Blank::seekInLine($line);
        if ($exception) {
            $this->setExpectedException('InvalidArgumentException');
        }
        $tag = new TagReturn($blank);
        if (!$exception) {
            $this->assertSame($types, $tag->getTypes());
            $this->assertSame($description, $tag->getDescription());
        }
    }

    /**
     * @return array
     */
    public function providerTag()
    {
        return [
            [
                '@return int the result',
                ['int'],
                'the result',
            ],
            [
                "@return int the result\n    second",
                ['int'],
                "the result\nsecond",
            ],
            [
                '@return int|string the result',
                ['int', 'string'],
                'the result',
            ],
            [
                '@return (int|string) the result',
                ['int', 'string'],
                'the result',
            ],
            [
                '@return int',
                ['int'],
                null,
            ],
            [
                '@return $int',
                [],
                '$int',
            ],
            [
                '@return',
                [],
                null,
            ],
            [
                '@link 11',
                null,
                null,
                true,
            ],
        ];
    }
}
