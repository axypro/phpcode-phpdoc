<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * The base class for tags such as var, param, return, property[-*]
 */
class TagBaseVar extends TagBaseTyped
{
    /**
     * Returns the var name
     *
     * @return array
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * {@inheritdoc}
     */
    protected function parseText($text)
    {
        parent::parseText($text);
        if (preg_match('/^\$(\S+)(.*?)$/', $this->description, $matches)) {
            $this->name = $matches[1];
            $this->description = trim($matches[2]);
            if ($this->description === '') {
                $this->description = null;
            }
        }
    }

    /**
     * @var string
     */
    protected $name;
}
