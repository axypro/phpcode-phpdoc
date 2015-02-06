<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc;

use axy\phpcode\phpdoc\helpers\Normalizer;
use axy\phpcode\phpdoc\annotations\Parser;
use axy\phpcode\phpdoc\annotations\Tag;

/**
 * The PHPDoc-block class
 */
class Block
{
    /**
     * The constructor
     *
     * @param string $text
     *        the block text
     */
    public function __construct($text)
    {
        $this->original = $text;
        $this->lines = Normalizer::toLines($text);
    }

    /**
     * Returns the original comment text
     *
     * @return string
     */
    public function getOriginalText()
    {
        return $this->original;
    }

    /**
     * Returns the normalized comment text
     *
     * @return string
     */
    public function getNormalizedText()
    {
        return implode("\n", $this->lines);
    }

    /**
     * Returns a text part of the comment (before an annotation part)
     *
     * @param bool $asArray [optional]
     * @return string
     */
    public function getPartText($asArray = false)
    {
        if ($this->partText === null) {
            $this->splitParts();
        }
        if ($asArray) {
            return $this->partText;
        }
        return implode("\n", $this->partText);
    }

    /**
     * Returns the annotations text
     *
     * @param bool $asArray [optional]
     * @return string
     */
    public function getPartAnnotation($asArray = false)
    {
        if ($this->partText === null) {
            $this->splitParts();
        }
        if ($asArray) {
            return $this->partAnnotation;
        }
        return implode("\n", $this->partAnnotation);
    }

    /**
     * Returns the title of the block
     *
     * @return string|null
     */
    public function getTitle()
    {
        if ($this->title === false) {
            $partText = $this->getPartText(true);
            if (empty($partText)) {
                $this->title = null;
            } else {
                $this->title = $partText[0];
            }
        }
        return $this->title;
    }

    /**
     * Returns the description of the block
     *
     * @return string|null
     */
    public function getDescription()
    {
        if ($this->description === false) {
            $partText = $this->getPartText(true);
            $count = count($partText);
            if ($count > 1) {
                $this->description = trim(implode("\n", array_slice($partText, 1)));
            } else {
                $this->description = null;
            }
        }
        return $this->description;
    }

    /**
     * Returns the annotations list
     *
     * @param array|string|null $filter [optional]
     *        a tag or a tags list of required annotations
     * @return \axy\phpcode\phpdoc\annotations\Tag[]
     */
    public function getAnnotations($filter = null)
    {
        if ($this->annotations === null) {
            $partAnnotation = $this->getPartAnnotation(true);
            $this->annotations = [];
            foreach (Parser::parseAnnotationBlock($partAnnotation) as $blank) {
                $this->annotations[] = new Tag($blank);
            }
        }
        if ($filter === null) {
            return $this->annotations;
        }
        $result = [];
        if (!is_array($filter)) {
            $filter = [$filter];
        }
        foreach ($this->annotations as $annotation) {
            if (in_array($annotation->getTag(), $filter)) {
                $result[] = $annotation;
            }
        }
        return $result;
    }

    /**
     * Splits the comment to a text part and an annotation part
     */
    private function splitParts()
    {
        foreach ($this->lines as $i => $line) {
            if ((substr($line, 0, 1) === '@') || (substr($line, 0, 13) === '{@inheritdoc}')) {
                $this->partText = Normalizer::trimLinesEnd(array_slice($this->lines, 0, $i - 1));
                $this->partAnnotation = array_slice($this->lines, $i);
                return;
            }
        }
        $this->partText = $this->lines;
        $this->partAnnotation = [];
    }

    /**
     * The original text
     *
     * @var string
     */
    protected $original;

    /**
     * The lines of the normalized text
     *
     * @var array
     */
    protected $lines;

    /**
     * The lines of the text part
     *
     * @var array
     */
    protected $partText;

    /**
     * The lines of the annotation part
     *
     * @var array
     */
    protected $partAnnotation;

    /**
     * The title of the block (FALSE - is not loaded)
     *
     * @var string|null|bool
     */
    protected $title = false;

    /**
     * The description of the block (FALSE - is not loaded)
     *
     * @var string|null|bool
     */
    protected $description = false;

    /**
     * @var array
     */
    protected $annotations;
}
