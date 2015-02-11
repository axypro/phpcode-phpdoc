<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc;

/**
 * Doc block for a method
 */
class DocMethod extends Doc
{
    /**
     * Returns the list of param annotations
     *
     * @return \axy\phpcode\phpdoc\annotations\TagParams[]
     */
    public function getParams()
    {
        return $this->find('param', 'TagParam');
    }

    /**
     * Returns the list of the return annotation
     *
     * @return \axy\phpcode\phpdoc\annotations\TagReturn
     */
    public function getReturn()
    {
        return $this->find('return', 'TagReturn', true);
    }

    /**
     * Returns the list of the throws annotation
     *
     * @return \axy\phpcode\phpdoc\annotations\TagThrows[]
     */
    public function getThrows()
    {
        return $this->find('throws', 'TagThrows');
    }
}
