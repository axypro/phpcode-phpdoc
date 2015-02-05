<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\Block;

/**
 * coversDefaultClass axy\phpcode\phpdoc\Block
 */
class BlockTest extends \PHPUnit_Framework_TestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        if ($this->fullComment === null) {
            $this->fullComment = $this->getFileContent('full');
        }
    }

    /**
     * covers ::getOriginalText
     */
    public function testGetOriginalText()
    {
        $block = new Block($this->fullComment);
        $this->assertSame($this->fullComment, $block->getOriginalText());
    }

    /**
     * covers ::getNormalizedText
     */
    public function testGetNormalizedText()
    {
        $block = new Block($this->fullComment);
        $expected = $this->getFileContent('full-normalized');
        $this->assertSame($expected, $block->getNormalizedText());
        $block2 = new Block('/** @source */');
        $this->assertSame('@source', $block2->getNormalizedText());
    }

    /**
     * covers ::getPartText
     */
    public function testGetPartText()
    {
        $block = new Block($this->fullComment);
        $expected = $this->getFileContent('full-text');
        $this->assertSame($expected, $block->getPartText());
        $block2 = new Block('/** @source */');
        $this->assertSame('', $block2->getPartText());
        $block3 = new Block('/** source */');
        $this->assertSame('source', $block3->getPartText());
    }

    /**
     * covers ::getPartAnnotation
     */
    public function testGetPartAnnotation()
    {
        $block = new Block($this->fullComment);
        $expected = $this->getFileContent('full-annotation');
        $this->assertSame($expected, $block->getPartAnnotation());
        $block2 = new Block('/** @source */');
        $this->assertSame('@source', $block2->getPartAnnotation());
        $block3 = new Block('/** source */');
        $this->assertSame('', $block3->getPartAnnotation());
    }

    /**
     * @param string $file
     * @return string
     */
    private function getFileContent($file)
    {
        return trim(file_get_contents(__DIR__.'/helpers/tst/'.$file.'.txt'));
    }

    /**
     * @var string
     */
    private $fullComment;
}
