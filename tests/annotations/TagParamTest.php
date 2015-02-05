<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\TagParam;
use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\TagParam
 */
class TagParamTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getTypes
     * covers ::getName
     * covers ::getDescription
     * @dataProvider providerTag
     * @param string $line
     * @param string $types
     * @param string $name
     * @param string $optional
     * @param string $description
     * @param bool $exception [optional]
     */
    public function testTag($line, $types, $name, $optional, $description, $exception = false)
    {
        $blank = Blank::seekInLine($line);
        if ($exception) {
            $this->setExpectedException('InvalidArgumentException');
        }
        $tag = new TagParam($blank);
        if (!$exception) {
            $this->assertSame($types, $tag->getTypes());
            $this->assertSame($name, $tag->getName());
            $this->assertSame($optional, $tag->isOptional());
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
                "@param (int|\\my\\TestClass) \$one [optional]\n      an argument",
                ['int', '\my\TestClass'],
                'one',
                true,
                'an argument',
            ],
            [
                "@param (int|\\my\\TestClass) \$one an argument",
                ['int', '\my\TestClass'],
                'one',
                false,
                'an argument',
            ],
            [
                "@param \$one",
                [],
                'one',
                false,
                null,
            ],
            [
                '@var string $x',
                [],
                null,
                false,
                null,
                true,
            ],
        ];
    }
}
