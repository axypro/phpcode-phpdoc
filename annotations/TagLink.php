<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

use axy\phpcode\phpdoc\helpers\Uri;

/**
 * Tag "link"
 */
class TagLink extends Tag
{
    /**
     * Returns the URI of the link
     *
     * @return string|null
     */
    public function getURI()
    {
        return $this->uri;
    }

    /**
     * Returns the description
     *
     * @return string|null
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
        if (preg_match('/^(\S+)(.*?)$/is', $text, $matches)) {
            $uri = $matches[1];
            if (Uri::isURI($uri)) {
                $this->uri = $uri;
                $this->description = trim($matches[2]);
            }
        }
        if ($this->uri === null) {
            $this->description = $text;
        }
        if ($this->description === '') {
            $this->description = null;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected $requiredTag = 'link';

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $description;
}
