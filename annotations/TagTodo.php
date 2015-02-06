<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

use axy\phpcode\phpdoc\helpers\Uri;

/**
 * Tag "todo"
 */
class TagTodo extends Tag
{
    /**
     * Returns the target user
     *
     * @return string|null
     */
    public function getUser()
    {
        return $this->user;
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
        if (preg_match('/^{(.*?)}(.*?)$/s', $text, $matches)) {
            $user = trim($matches[1]);
            if ($user !== '') {
                $this->user = $user;
            }
            $this->description = trim($matches[2]);
        } else {
            $this->description = $text;
        }
        if ($this->description === '') {
            $this->description = null;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected $requiredTag = 'todo';

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $description;
}
