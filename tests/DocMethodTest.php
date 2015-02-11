<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\DocMethod;

/**
 * coversDefaultClass axy\phpcode\phpdoc\DocMethod
 */
class DocMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getParams
     * covers ::getReturn
     * covers ::getThrows
     */
    public function testMethod()
    {
        $doc = new DocMethod(trim(file_get_contents(__DIR__.'/tst/method.txt')));
        $this->assertSame('This is method', $doc->getTitle());
        $this->assertSame([], $doc->getAuthors());
        $params = $doc->getParams();
        $this->assertInternalType('array', $params);
        $this->assertCount(2, $params);
        $pX = $params[0];
        $pY = $params[1];
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagParam', $pX);
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagParam', $pY);
        $this->assertSame('x', $pX->getName());
        $this->assertSame('a second argument', $pY->getDescription());
        $this->assertSame(['string'], $pX->getTypes());
        $this->assertFalse($pX->isOptional());
        $this->assertTrue($pY->isOptional());
        $return = $doc->getReturn();
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagReturn', $return);
        $this->assertSame(['string'], $return->getTypes());
        $this->assertSame('a result', $return->getDescription());
        $this->assertSame([], $doc->getThrows());
        $this->assertFalse($doc->isInherit());
    }

    /**
     * covers ::getParams
     * covers ::getReturn
     * covers ::getThrows
     */
    public function testMethodInherit()
    {
        $doc = new DocMethod(trim(file_get_contents(__DIR__.'/tst/method-inherit.txt')));
        $this->assertNull($doc->getTitle());
        $this->assertSame([], $doc->getAuthors());
        $this->assertSame([], $doc->getParams());
        $this->assertNull($doc->getReturn());
        $this->assertTrue($doc->isInherit());
        $this->assertSame('ok', $doc->getInheritdoc()->getText());
        $throwsList = $doc->getThrows();
        $this->assertInternalType('array', $throwsList);
        $this->assertCount(1, $throwsList);
        $throws = $throwsList[0];
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagThrows', $throws);
        $this->assertSame(['Exception'], $throws->getTypes());
        $this->assertSame(null, $throws->getDescription());
    }
}
