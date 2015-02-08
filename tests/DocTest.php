<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\Doc;

/**
 * coversDefaultClass axy\phpcode\phpdoc\Doc
 */
class DocTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getAuthors
     * covers ::getDeprecated
     * covers ::isDeprecated
     * covers ::getExamples
     * covers ::getInheritdoc
     * covers ::isInherit
     * covers ::getLinks
     * covers :;getTodoList
     */
    public function testClass()
    {
        $doc = new Doc(trim(file_get_contents(__DIR__.'/tst/class.txt')));
        $this->assertSame('This is doc of class', $doc->getTitle());
        $this->assertNull($doc->getDescription());
        $authors = $doc->getAuthors();
        $this->assertInternalType('array', $authors);
        $this->assertCount(1, $authors);
        $author = $authors[0];
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagAuthor', $author);
        $this->assertSame('Me', $author->getName());
        $this->assertSame('me@mail.loc', $author->getEmail());
        $this->assertNull($doc->getDeprecated());
        $this->assertFalse($doc->isDeprecated());
        $examples = $doc->getExamples();
        $this->assertInternalType('array', $examples);
        $this->assertCount(1, $examples);
        $example = $examples[0];
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagExample', $example);
        $this->assertSame('$x = new MyClass()', $example->getText());
        $this->assertNull($doc->getInheritdoc());
        $this->assertFalse($doc->isInherit());
        $links = $doc->getLinks();
        $this->assertInternalType('array', $links);
        $this->assertCount(2, $links);
        $linkDoc = $links[0];
        $linkRepo = $links[1];
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagLink', $linkDoc);
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagLink', $linkRepo);
        $this->assertSame('http://example.loc/doc', $linkDoc->getURI());
        $this->assertSame('doc', $linkDoc->getDescription());
        $this->assertSame('http://example.loc/repo.git', $linkRepo->getURI());
        $this->assertSame('repo', $linkRepo->getDescription());
        $todo = $doc->getTodoList();
        $this->assertInternalType('array', $todo);
        $this->assertCount(2, $todo);
        $todoJ = $todo[0];
        $todoN = $todo[1];
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagTodo', $todoJ);
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagTodo', $todoN);
        $this->assertSame('John', $todoJ->getUser());
        $this->assertSame('refactor it', $todoJ->getDescription());
        $this->assertNull($todoN->getUser());
        $this->assertSame('check John', $todoN->getDescription());
    }

    /**
     * covers ::getAuthors
     * covers ::getDeprecated
     * covers ::isDeprecated
     * covers ::getExamples
     * covers ::getInheritdoc
     * covers ::isInherit
     * covers ::getLinks
     * covers :;getTodoList
     */
    public function testMethod()
    {
        $doc = new Doc(trim(file_get_contents(__DIR__.'/tst/method.txt')));
        $this->assertSame('This is method', $doc->getTitle());
        $this->assertSame('The method do nothing', $doc->getDescription());
        $this->assertSame([], $doc->getAuthors());
        $this->assertSame([], $doc->getExamples());
        $this->assertSame([], $doc->getLinks());
        $this->assertSame([], $doc->getTodoList());
        $this->assertTrue($doc->isDeprecated());
        $deprecated = $doc->getDeprecated();
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagDeprecated', $deprecated);
        $this->assertSame('1.0', $deprecated->getVersion());
        $this->assertNull($deprecated->getDescription());
        $this->assertNull($doc->getInheritdoc());
        $this->assertFalse($doc->isInherit());
    }

    /**
     * covers ::getAuthors
     * covers ::getDeprecated
     * covers ::isDeprecated
     * covers ::getExamples
     * covers ::getInheritdoc
     * covers ::isInherit
     * covers ::getLinks
     * covers :;getTodoList
     */
    public function testMethodInherit()
    {
        $doc = new Doc(trim(file_get_contents(__DIR__.'/tst/method-inherit.txt')));
        $this->assertNull($doc->getTitle());
        $this->assertNull($doc->getDescription());
        $this->assertSame([], $doc->getAuthors());
        $this->assertSame([], $doc->getExamples());
        $this->assertSame([], $doc->getLinks());
        $this->assertSame([], $doc->getTodoList());
        $this->assertFalse($doc->isDeprecated());
        $this->assertNull($doc->getDeprecated());
        $this->assertTrue($doc->isInherit());
        $inherit = $doc->getInheritdoc();
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagInheritdoc', $inherit);
        $this->assertSame('ok', $inherit->getText());
    }
}
