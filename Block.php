<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc;

use axy\phpcode\phpdoc\helpers\Normalizer;

/**
 * The PHPDoc-block class
 */
class Block
{
    /**
     * The constructor
     *
     * @param string $text
     *        the block text
     */
    public function __construct($text)
    {
        $this->original = $text;
        $this->lines = Normalizer::toLines($text);
    }

    /**
     * Returns the original comment text
     *
     * @return string
     */
    public function getOriginalText()
    {
        return $this->original;
    }

    /**
     * Returns the normalized comment text
     *
     * @return string
     */
    public function getNormalizedText()
    {
        return implode("\n", $this->lines);
    }

    /**
     * Returns a text part of the comment (before an annotation part)
     *
     * @return string
     */
    public function getPartText()
    {
        if ($this->partText === null) {
            $this->splitParts();
        }
        return implode("\n", $this->partText);
    }

    /**
     * Returns the annotations text
     *
     * @return string
     */
    public function getPartAnnotation()
    {
        if ($this->partText === null) {
            $this->splitParts();
        }
        return implode("\n", $this->partAnnotation);
    }

    /**
     * Splits the comment to a text part and an annotation part
     */
    private function splitParts()
    {
        foreach ($this->lines as $i => $line) {
            if ((substr($line, 0, 1) === '@') || (substr($line, 0, 13) === '{@inheritdoc}')) {
                $this->partText = Normalizer::trimLinesEnd(array_slice($this->lines, 0, $i - 1));
                $this->partAnnotation = array_slice($this->lines, $i);
                return;
            }
        }
        $this->partText = $this->lines;
        $this->partAnnotation = [];
    }

    /**
     * The original text
     *
     * @var string
     */
    private $original;

    /**
     * The lines of the normalized text
     *
     * @var array
     */
    private $lines;

    /**
     * The lines of the text part
     *
     * @var array
     */
    private $partText;

    /**
     * The lines of the annotation part
     *
     * @var array
     */
    private $partAnnotation;
}
