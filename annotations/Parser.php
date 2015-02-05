<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Parser for annotation blocks
 */
class Parser
{
    /**
     * Parses an annotation block
     *
     * @param string|array $block
     *        the text of the block or the list of lines
     * @return array
     *         the list of annotations blanks
     */
    public static function parseAnnotationBlock($block)
    {
        if (!is_array($block)) {
            $block = explode("\n", $block);
        }
        $blanks = [];
        $current = null;
        foreach ($block as $line) {
            $next = Blank::seekInLine($line);
            if ($next) {
                if ($current) {
                    $current->stop();
                    $blanks[] = $current;
                }
                $current = $next;
            } elseif ($current) {
                $current->appendLine($line);
            }
        }
        if ($current) {
            $current->stop();
            $blanks[] = $current;
        }
        return $blanks;
    }
}
