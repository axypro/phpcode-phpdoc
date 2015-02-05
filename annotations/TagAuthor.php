<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Tag "author"
 */
class TagAuthor extends Tag
{
    /**
     * Returns the author name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the author email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    protected function parseText($text)
    {
        $pattern = '/^(.*?)(<(.*?)>)?$/is';
        if (preg_match($pattern, $text, $matches)) {
            if (isset($matches[1])) {
                $this->name = trim($matches[1]);
                if ($this->name === '') {
                    $this->name = null;
                }
            }
            if (isset($matches[3])) {
                $this->email = trim($matches[3]);
            }
        }
    }

    protected $requiredTag = 'author';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;
}
