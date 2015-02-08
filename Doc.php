<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc;

/**
 * Doc block of some item (class, method or var)
 */
class Doc extends Block
{
    /**
     * Returns the list of authors
     *
     * @return \axy\phpcode\phpdoc\annotations\TagAuthor[]
     */
    public function getAuthors()
    {
        return $this->find('author', 'TagAuthor');
    }

    /**
     * Returns the deprecated annotation
     *
     * @return \axy\phpcode\phpdoc\annotations\TagDeprecated
     */
    public function getDeprecated()
    {
        return $this->find('deprecated', 'TagDeprecated', true);
    }

    /**
     * Checks if the item is deprecated
     *
     * @return bool
     */
    public function isDeprecated()
    {
        return ($this->getDeprecated() !== null);
    }

    /**
     * Returns the list of examples
     *
     * @return \axy\phpcode\phpdoc\annotations\TagExample[]
     */
    public function getExamples()
    {
        return $this->find('example', 'TagExample');
    }

    /**
     * Returns the inheritdoc annotation
     *
     * @return \axy\phpcode\phpdoc\annotations\TagInheritdoc
     */
    public function getInheritdoc()
    {
        return $this->find('inheritdoc', 'TagInheritdoc', true);
    }

    /**
     * Checks if the item doc is inherit from a parent item
     *
     * @return bool
     */
    public function isInherit()
    {
        return ($this->getInheritdoc() !== null);
    }

    /**
     * Returns the list of links
     *
     * @return \axy\phpcode\phpdoc\annotations\TagLink[]
     */
    public function getLinks()
    {
        return $this->find('link', 'TagLink');
    }

    /**
     * Returns the list of todo
     *
     * @return \axy\phpcode\phpdoc\annotations\TagTodo[]
     */
    public function getTodoList()
    {
        return $this->find('todo', 'TagTodo');
    }

    /**
     * @param string|array $tag
     * @param string $tagClass
     * @param bool $single [optional]
     * @return \axy\phpcode\phpdoc\annotations\Tag|\axy\phpcode\phpdoc\annotations\Tag[]|null
     */
    protected function find($tag, $tagClass, $single = false)
    {
        $key = is_array($tag) ? $tag[0] : $tag;
        if (!array_key_exists($key, $this->cacheFind)) {
            $result = [];
            $cn = __NAMESPACE__.'\\annotations\\'.$tagClass;
            foreach ($this->getAnnotations($tag) as $t) {
                $result[] = new $cn($t);
            }
            if ($single) {
                $result = empty($result) ? null : $result[0];
            }
            $this->cacheFind[$key] = $result;
        }
        return $this->cacheFind[$key];
    }

    /**
     * @var array
     */
    protected $cacheFind = [];
}
