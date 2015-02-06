<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\TagThrows;
use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\TagThrows
 */
class TagThrowsTest extends \PHPUnit_Framework_TestCase
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
        $tag = new TagThrows($blank);
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
                '@throws \LogicException error in logic',
                ['\LogicException'],
                'error in logic',
            ],
            [
                '@throws (LogicException|RuntimeException) error in logic or not',
                ['LogicException', 'RuntimeException'],
                'error in logic or not',
            ],
            [
                '@throws LogicException ',
                ['LogicException'],
                null,
            ],
            [
                '@throws',
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
