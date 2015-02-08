<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\DocClass;

/**
 * coversDefaultClass axy\phpcode\phpdoc\DocClass
 */
class DocClassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getProperties
     */
    public function testGetProperties()
    {
        $doc = new DocClass(trim(file_get_contents(__DIR__.'/tst/class.txt')));
        $this->assertSame('This is doc of class', $doc->getTitle());
        $this->assertSame('Me', $doc->getAuthors()[0]->getName());
        $props = $doc->getProperties();
        $this->assertInternalType('array', $props);
        $this->assertCount(3, $props);
        $propOne = $props[0];
        $propTwo = $props[1];
        $propThree = $props[2];
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagProperty', $propOne);
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagProperty', $propTwo);
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagProperty', $propThree);
        $this->assertSame('one', $propOne->getName());
        $this->assertSame('this is two', $propTwo->getDescription());
        $this->assertSame(['string'], $propThree->getTypes());
        $this->assertFalse($propOne->isWritable());
        $this->assertTrue($propTwo->isWritable());
        $this->assertTrue($propThree->isWritable());
        $this->assertTrue($propOne->isReadable());
        $this->assertFalse($propTwo->isReadable());
        $this->assertTrue($propThree->isReadable());
    }
}
