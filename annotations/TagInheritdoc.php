<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Tag "inheritdoc"
 */
class TagInheritdoc extends Tag
{
    /**
     * {@inheritdoc}
     */
    protected $requiredTag = 'inheritdoc';
}
