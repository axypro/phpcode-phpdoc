<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\DocVar;

/**
 * coversDefaultClass axy\phpcode\phpdoc\DocVar
 */
class DocVarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getProperties
     */
    public function testGetAnnotation()
    {
        $comment = "/**\n * The variable\n * @var string \$x description\n */";
        $doc = new DocVar($comment);
        $this->assertSame('The variable', $doc->getTitle());
        $annotation = $doc->getVarAnnotation();
        $this->assertInstanceOf('axy\phpcode\phpdoc\annotations\TagVar', $annotation);
        $this->assertSame(['string'], $annotation->getTypes());
        $this->assertSame('x', $annotation->getName());
        $this->assertSame('description', $annotation->getDescription());
    }
}
