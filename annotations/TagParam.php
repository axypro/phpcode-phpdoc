<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Tag "param"
 */
class TagParam extends TagBaseVar
{
    /**
     * Checks if the method parameter is optional
     *
     * @return bool
     */
    public function isOptional()
    {
        return $this->optional;
    }

    /**
     * {@inheritdoc}
     */
    protected function parseText($text)
    {
        parent::parseText($text);
        if (substr($this->description, 0, 10) === '[optional]') {
            $this->optional = true;
            $this->description = trim(substr($this->description, 10));
            if ($this->description === '') {
                $this->description = null;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    protected $requiredTag = 'param';

    /**
     * @var bool
     */
    protected $optional = false;
}
