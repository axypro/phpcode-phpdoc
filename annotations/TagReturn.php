<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Tag "return"
 */
class TagReturn extends TagBaseTyped
{
    /**
     * {@inheritdoc}
     */
    protected $requiredTag = 'return';
}
