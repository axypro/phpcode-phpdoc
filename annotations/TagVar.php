<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Tag "var"
 */
class TagVar extends TagBaseVar
{
    /**
     * {@inheritdoc}
     */
    protected $requiredTag = 'var';
}
