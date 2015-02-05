<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\annotations;

/**
 * Tag "deprecated"
 */
class TagDeprecated extends Tag
{
    /**
     * Returns the version
     *
     * @return string|null
     */
    public function getVersion()
    {
        return $this->version;
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
        $pattern = '/^([0-9]+\.\S+)(.*)$/s';
        if (preg_match($pattern, $text, $matches)) {
            $this->version = $matches[1];
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
    protected $requiredTag = 'deprecated';

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $description;
}
