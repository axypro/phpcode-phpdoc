<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Blank of an annotation
 *
 * For example: @+tag(data) text
 */
class Blank
{
    /**
     * @var string
     */
    public $tag;

    /**
     * @var string|null
     */
    public $data;

    /**
     * @var string
     */
    public $text;

    /**
     * Seeks annotation in a line
     *
     * @param string $line
     * @return \axy\phpcode\phpdoc\annotations\Blank|null
     */
    public static function seekInLine($line)
    {
        if (preg_match('/^@(\S+)(.*?)$/s', $line, $matches)) {
            return new self($matches[1], trim($matches[2]));
        }
        if (substr($line, 0, 13) === '{@inheritdoc}') {
            return new self('inheritdoc', trim(substr($line, 13)));
        }
        return null;
    }

    /**
     * The constructor
     *
     * @param string $annotation
     * @param string $text
     */
    public function __construct($annotation, $text)
    {
        if (preg_match('/^([^(]+)\((.*?)\)$/', $annotation, $matches)) {
            $this->tag = $matches[1];
            $this->data = $matches[2];
        } else {
            $this->tag = $annotation;
        }
        $this->text = $text;
    }

    /**
     * @param string $line
     */
    public function appendLine($line)
    {
        $this->text .= "\n".$line;
    }

    /**
     * Text ended
     */
    public function stop()
    {
        $this->text = trim($this->text);
    }
}
