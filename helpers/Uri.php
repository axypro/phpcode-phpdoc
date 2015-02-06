<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\helpers;

/**
 * Helper for URI
 */
class Uri
{
    /**
     * Checks if a string is URI
     *
     * @param string $string
     * @return bool
     */
    public static function isURI($string)
    {
        return (bool)preg_match('~^([a-z]+:)?//~is', $string);
    }
}
