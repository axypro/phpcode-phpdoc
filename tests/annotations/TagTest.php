<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\Tag;
use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\Tag
 */
class TagTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getTag
     * covers ::getData
     * covers ::getText
     */
    public function testTag()
    {
        $blank = Blank::seekInLine('@tag(data) text');
        $tag = new Tag($blank);
        $this->assertSame('tag', $tag->getTag());
        $this->assertSame('data', $tag->getData());
        $this->assertSame('text', $tag->getText());
    }
}
