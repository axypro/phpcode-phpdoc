<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\TagLink;
use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\TagLink
 */
class TagLinkTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getURI
     * covers ::getDescription
     * @dataProvider providerTag
     * @param string $line
     * @param string $uri
     * @param string $description
     * @param bool $exception [optional]
     */
    public function testTag($line, $uri, $description, $exception = false)
    {
        $blank = Blank::seekInLine($line);
        if ($exception) {
            $this->setExpectedException('InvalidArgumentException');
        }
        $tag = new TagLink($blank);
        if (!$exception) {
            $this->assertSame($uri, $tag->getURI());
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
                '@link http://example.loc/doc The documentation',
                'http://example.loc/doc',
                'The documentation',
            ],
            [
                '@link file:///file.txt',
                'file:///file.txt',
                null,
            ],
            [
                '@link The documentation',
                null,
                'The documentation',
            ],
            [
                '@see {@link}',
                null,
                null,
                true,
            ],
        ];
    }
}
