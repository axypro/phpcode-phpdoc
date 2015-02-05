<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\TagDeprecated;
use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\TagDeprecated
 */
class TagDeprecatedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getVersion
     * covers ::getDescription
     * @dataProvider providerTag
     * @param string $line
     * @param string $version
     * @param string $description
     * @param bool $exception [optional]
     */
    public function testTag($line, $version, $description, $exception = false)
    {
        $blank = Blank::seekInLine($line);
        if ($exception) {
            $this->setExpectedException('InvalidArgumentException');
        }
        $tag = new TagDeprecated($blank);
        if (!$exception) {
            $this->assertSame($version, $tag->getVersion());
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
                '@deprecated 1.0-rc because that',
                '1.0-rc',
                'because that',
            ],
            [
                '@deprecated 1.0-rc ',
                '1.0-rc',
                null,
            ],
            [
                '@deprecated  because that',
                null,
                'because that',
            ],
            [
                '@deprecated',
                null,
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
