<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc;

/**
 * Doc block for a variable (including a class property)
 */
class DocVar extends Doc
{
    /**
     * Returns the var annotation
     *
     * @return \axy\phpcode\phpdoc\annotations\TagVar
     */
    public function getVarAnnotation()
    {
        return $this->find('var', 'TagVar', true);
    }
}
