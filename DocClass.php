<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc;

/**
 * Doc block for a class
 */
class DocClass extends Doc
{
    /**
     * Returns the list of property annotations
     *
     * @return \axy\phpcode\phpdoc\annotations\TagProperty[]
     */
    public function getProperties()
    {
        return $this->find(['property', 'property-read', 'property-write'], 'TagProperty');
    }
}
