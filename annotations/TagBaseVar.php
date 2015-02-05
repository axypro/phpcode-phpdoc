<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * The base class for tags such as var, param, return, property[-*]
 */
class TagBaseVar extends Tag
{
    /**
     * Returns the list of allowed types
     *
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    protected function parseText($text)
    {
        $this->types = [];
        if ($text === '') {
            return;
        }
        if ($text[0] === '$') {
            $this->description = $text;
            return;
        }
        if (preg_match('/^(\S+)(.*?)$/s', $text, $matches)) {
            $this->description = trim($matches[2]);
            $types = $matches[1];
            $types = preg_replace('/(^\()|(\)$)/s', '', $types);
            $this->types = explode('|', $types);
        } else {
            $this->description = $text;
        }
        if ($this->description === '') {
            $this->description = null;
        } else {
            $this->description = preg_replace('/\n\s*/', "\n", $this->description);
        }
    }

    /**
     * @var array
     */
    protected $types;

    /**
     * @var string
     */
    protected $description;
}
