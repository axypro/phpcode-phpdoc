<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Tag "author"
 */
class TagReturn extends TagBaseVar
{
    /**
     * {@inheritdoc}
     */
    protected $requiredTag = 'return';
}
