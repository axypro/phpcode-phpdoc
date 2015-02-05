<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\TagVar;
use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\TagVar
 */
class TagVarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getTypes
     * covers ::getName
     * covers ::getDescription
     * @dataProvider providerTag
     * @param string $line
     * @param string $types
     * @param string $name
     * @param string $description
     * @param bool $exception [optional]
     */
    public function testTag($line, $types, $name, $description, $exception = false)
    {
        $blank = Blank::seekInLine($line);
        if ($exception) {
            $this->setExpectedException('InvalidArgumentException');
        }
        $tag = new TagVar($blank);
        if (!$exception) {
            $this->assertSame($types, $tag->getTypes());
            $this->assertSame($name, $tag->getName());
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
                '@var (int|string) $prop this is property',
                ['int', 'string'],
                'prop',
                'this is property',
            ],
            [
                '@var (int|string) this is property',
                ['int', 'string'],
                null,
                'this is property',
            ],
            [
                '@var $prop this is property',
                [],
                'prop',
                'this is property',
            ],
            [
                '@var $prop ',
                [],
                'prop',
                null,
            ],
            [
                '@link 11',
                null,
                null,
                null,
                true,
            ],
        ];
    }
}
