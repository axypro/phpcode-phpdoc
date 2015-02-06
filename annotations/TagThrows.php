<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Tag "throws"
 */
class TagThrows extends TagBaseTyped
{
    /**
     * {@inheritdoc}
     */
    protected $requiredTag = 'throws';
}
