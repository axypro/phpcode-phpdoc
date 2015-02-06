<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\TagTodo;
use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\TagTodo
 */
class TagTodoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getUser
     * covers ::getDescription
     * @dataProvider providerTag
     * @param string $line
     * @param string $user
     * @param string $description
     * @param bool $exception [optional]
     */
    public function testTag($line, $user, $description, $exception = false)
    {
        $blank = Blank::seekInLine($line);
        if ($exception) {
            $this->setExpectedException('InvalidArgumentException');
        }
        $tag = new TagTodo($blank);
        if (!$exception) {
            $this->assertSame($user, $tag->getUser());
            $this->assertSame($description, $tag->getDescription());
        }
    }

    /**
     * @return array
     */
    public function providerTag()
    {
        return [
            [
                '@todo {Nick} Fix it!',
                'Nick',
                'Fix it!',
            ],
            [
                '@todo Nick Fix it!',
                null,
                'Nick Fix it!',
            ],
            [
                '@todo {} Fix it!',
                null,
                'Fix it!',
            ],
            [
                '@todo { Nick }',
                'Nick',
                null,
            ],
            [
                '@todo',
                null,
                null,
            ],
            [
                '@see {@link}',
                null,
                null,
                true,
            ],
        ];
    }
}
