<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\helpers;

/**
 * Normalizes a phpdoc-block
 */
class Normalizer
{
    /**
     * Removes edging and explodes the block on the lines
     *
     * @param string $block
     * @return array
     */
    public static function toLines($block)
    {
        $block = preg_replace('~^/\*\*(\s*\n)?~is', '', $block);
        $block = preg_replace('~\*/~is', '', $block);
        $block = preg_replace('/\s*\*\//s', "\n", $block);
        $lines = explode("\n", $block);
        foreach ($lines as &$line) {
            $line = rtrim($line);
            $line = preg_replace('/^\s*\*/s', '', $line);
        }
        unset($line);
        $lines = self::trimLines($lines);
        $lines = self::shiftToLeft($lines);
        return $lines;
    }

    /**
     * Shifts the text to the left
     *
     * @param array $lines
     * @return array
     */
    public static function shiftToLeft(array $lines)
    {
        $min = null;
        foreach ($lines as $line) {
            if ($line !== '') {
                if (!preg_match('/^\s+/s', $line, $matches)) {
                    return $lines;
                }
                $len = strlen($matches[0]);
                if (($min === null) || ($len < $min)) {
                    $min = $len;
                }
            }
        }
        if ($min > 0) {
            foreach ($lines as &$line) {
                $line = substr($line, $min);
                if ($line === false) {
                    $line = '';
                }
            }
            unset($line);
        }
        return $lines;
    }

    /**
     * Removes empty lines from the beginning and the end
     *
     * @param array $lines
     * @return array
     */
    public static function trimLines(array $lines)
    {
        return self::trimLinesBegin(self::trimLinesEnd($lines));
    }

    /**
     * Removes empty lines from the beginning
     *
     * @param array $lines
     * @return array
     */
    public static function trimLinesBegin(array $lines)
    {
        foreach ($lines as $i => $line) {
            if ($line !== '') {
                if ($i > 0) {
                    $lines = array_slice($lines, $i);
                }
                return $lines;
            }
        }
        return [];
    }

    /**
     * Removes empty lines from the end
     *
     * @param array $lines
     * @return array
     */
    public static function trimLinesEnd(array $lines)
    {
        $last = count($lines) - 1;
        for ($i = $last; $i >= 0; $i--) {
            $line = $lines[$i];
            if ($line !== '') {
                if ($i < $last) {
                    $lines = array_slice($lines, 0, $i + 1);
                }
                return $lines;
            }
        }
        return [];
    }
}
