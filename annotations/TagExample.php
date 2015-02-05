<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Tag "example"
 */
class TagExample extends Tag
{
    /**
     * {@inheritdoc}
     */
    protected $requiredTag = 'example';
}
