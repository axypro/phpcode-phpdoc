<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\TagProperty;
use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\TagProperty
 */
class TagPropertyTest extends \PHPUnit_Framework_TestCase
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
     * @param bool $writable
     * @param bool $readable
     * @param bool $exception [optional]
     */
    public function testTag($line, $types, $name, $description, $writable, $readable, $exception = false)
    {
        $blank = Blank::seekInLine($line);
        if ($exception) {
            $this->setExpectedException('InvalidArgumentException');
        }
        $tag = new TagProperty($blank);
        if (!$exception) {
            $this->assertSame($types, $tag->getTypes());
            $this->assertSame($name, $tag->getName());
            $this->assertSame($description, $tag->getDescription());
            $this->assertSame($writable, $tag->isWritable());
            $this->assertSame($readable, $tag->isReadable());
        }
    }

    /**
     * @return array
     */
    public function providerTag()
    {
        return [
            [
                "@property string \$prop\n    description",
                ['string'],
                'prop',
                'description',
                true,
                true,
            ],
            [
                '@property-read string $prop description',
                ['string'],
                'prop',
                'description',
                false,
                true,
            ],
            [
                '@property-write string $prop description',
                ['string'],
                'prop',
                'description',
                true,
                false,
            ],
            [
                '@property-read string',
                ['string'],
                null,
                null,
                false,
                true,
            ],
            [
                '@property-wtf string $prop',
                null,
                null,
                null,
                null,
                null,
                true,
            ],
        ];
    }
}
