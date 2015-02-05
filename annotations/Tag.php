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
        if ($this->requiredTag && ($this->requiredTag !== $this->tag)) {
            throw new \InvalidArgumentException('Require @'.$this->requiredTag.', but @'.$this->tag.' given');
        }
        $this->parseText($this->text);
        $this->parseData($this->data);
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
     *
     * @param string $text
     */
    protected function parseText($text)
    {
    }

    /**
     * Parses the annotation data
     * For override
     *
     * @param string|null $data
     */
    protected function parseData($data)
    {
    }

    /**
     * @var string
     */
    protected $requiredTag;

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
