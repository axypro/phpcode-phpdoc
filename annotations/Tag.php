<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * The base annotation class
 */
class Tag
{
    /**
     * The constructor
     *
     * @param (\axy\phpcode\phpdoc\annotations\Blank|\axy\phpcode\phpdoc\annotations\Tag|array) $annotation
     */
    public function __construct($annotation)
    {
        if (is_array($annotation)) {
            $this->tag = $annotation['tag'];
            $this->data = $annotation['data'];
            $this->text = $annotation['text'];
        } elseif (is_object($annotation)) {
            $this->tag = $annotation->tag;
            $this->data = $annotation->data;
            $this->text = $annotation->text;
        } else {
            throw new \InvalidArgumentException('Require array or object');
        }
        $this->parseText();
        $this->parseData();
    }

    /**
     * Returns the annotation tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Returns the annotation data
     *
     * @return string|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Returns the annotation text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Parses the annotation text
     * For override
     */
    protected function parseText()
    {
    }

    /**
     * Parses the annotation data
     * For override
     */
    protected function parseData()
    {
    }

    /**
     * The annotation tag
     *
     * @var string
     */
    protected $tag;

    /**
     * The annotation data
     *
     * @var string|null
     */
    protected $data;

    /**
     * The annotation text
     *
     * @var string
     */
    protected $text;
}
