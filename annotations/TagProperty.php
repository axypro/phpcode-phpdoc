<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Tag "property[-*]"
 */
class TagProperty extends TagBaseVar
{
    /**
     * Checks if the property is writable
     *
     * @return bool
     */
    public function isWritable()
    {
        return $this->writable;
    }

    /**
     * Checks if the property is readable
     *
     * @return bool
     */
    public function isReadable()
    {
        return $this->readable;
    }

    /**
     * {@inheritdoc}
     */
    protected function parseText($text)
    {
        parent::parseText($text);
        if ($this->tag === 'property-read') {
            $this->writable = false;
        } elseif ($this->tag === 'property-write') {
            $this->readable = false;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected $requiredTag = ['property', 'property-read', 'property-write'];

    /**
     * @var bool
     */
    private $writable = true;

    /**
     * @var bool
     */
    private $readable = true;
}
