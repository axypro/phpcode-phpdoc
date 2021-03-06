<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\Block;

/**
 * coversDefaultClass axy\phpcode\phpdoc\Block
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
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
        $actual = $block->getNormalizedText();
        $expected = $this->fixLN($expected);
        $actual = $this->fixLN($actual);
        $this->assertSame($expected, $actual);
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
        $actual = $block->getPartText();
        $expected = $this->fixLN($expected);
        $actual = $this->fixLN($actual);
        $this->assertSame($expected, $actual);
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
        $actual = $block->getPartAnnotation();
        $expected = $this->fixLN($expected);
        $actual = $this->fixLN($actual);
        $this->assertSame($expected, $actual);
        $block2 = new Block('/** @source */');
        $this->assertSame('@source', $block2->getPartAnnotation());
        $block3 = new Block('/** source */');
        $this->assertSame('', $block3->getPartAnnotation());
    }

    /**
     * covers ::getTitle
     */
    public function testGetTitle()
    {
        $block = new Block($this->fullComment);
        $this->assertSame('This is title of the block', $block->getTitle());
        $block2 = new Block('/** @source */');
        $this->assertSame(null, $block2->getTitle());
        $block3 = new Block('/** Title @source */');
        $this->assertSame('Title @source', $block3->getTitle());
    }

    /**
     * covers ::getDescription
     */
    public function testGetDescription()
    {
        $block = new Block($this->fullComment);
        $expected = "This is description.\nMultiline and contains inline tags ({@see example}).";
        $actual = $block->getDescription();
        $this->assertSame($expected, $actual);
        $block2 = new Block('/** @source */');
        $this->assertSame(null, $block2->getDescription());
        $block3 = new Block('/** Title @source */');
        $this->assertSame(null, $block3->getDescription());
    }

    /**
     * covers ::getAnnotations
     * @dataProvider providerGetAnnotations
     * @param mixed $filter
     * @param array $expectedList
     */
    public function testGetAnnotations($filter, $expectedList)
    {
        $block = new Block($this->fullComment);
        $annotations = $block->getAnnotations($filter);
        $this->assertInternalType('array', $annotations);
        $this->assertCount(count($expectedList), $annotations);
        foreach ($expectedList as $i => $expected) {
            $this->assertArrayHasKey($i, $annotations);
            $tag = $annotations[$i];
            $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\Tag', $tag);
            $this->assertSame($expected['tag'], $tag->getTag());
            $this->assertSame($expected['text'], $tag->getText());
            $this->assertNull($tag->getData());
        }
    }

    /**
     * @return array
     */
    public function providerGetAnnotations()
    {
        $p1 = [
            'tag' => 'param',
            'text' => "int \$one\n       a first argument",
        ];
        $p2 = [
            'tag' => 'param',
            'text' => "(int|string) \$two [optional]\n       a second argument",
        ];
        $r = [
            'tag' => 'return',
            'text' => "int\n        the result",
        ];
        return [
            [null, [$p1, $p2, $r]],
            ['example', []],
            ['param', [$p1, $p2]],
            ['return', [$r]],
            [['return', 'param', 'var'], [$p1, $p2, $r]],
        ];
    }

    /**
     * @dataProvider providerEmptyTitle
     * @param string $comment
     */
    public function testEmptyTitle($comment)
    {
        $block = new Block($comment);
        $this->assertNull($block->getTitle());
    }

    /**
     * @return array
     */
    public function providerEmptyTitle()
    {
        return [
            [''],
            ['/**  */'],
            ['/** @source */'],
            ['/** {@inheritdoc} */'],
            ["/**\n * {@inheritdoc}\n * Text\n */"],
        ];
    }

    public function testNoEmptyLine()
    {
        $block = new Block("/**\n * The title\n * @var string\n */");
        $this->assertEquals(['The title'], $block->getPartText(true));
        $this->assertEquals(['@var string'], $block->getPartAnnotation(true));
        $block2 = new Block("/** The title */ */");
        $this->assertEquals(['The title'], $block2->getPartText(true));
        $this->assertEquals([], $block2->getPartAnnotation(true));
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
     * @param string $str
     * @return string
     */
    private function fixLN($str)
    {
        return str_replace("\r\n", "\n", $str);
    }

    /**
     * @var string
     */
    private $fullComment;
}
