<?php
/**
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\phpcode\phpdoc\tests;

use axy\phpcode\phpdoc\annotations\TagAuthor;
use axy\phpcode\phpdoc\annotations\Blank;

/**
 * coversDefaultClass axy\phpcode\phpdoc\annotations\Tag
 */
class TagAuthorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getName
     * covers ::getEmail
     * @dataProvider providerTag
     * @param string $line
     * @param string $name
     * @param string $email
     * @param bool $exception [optional]
     */
    public function testTag($line, $name, $email, $exception = false)
    {
        $blank = Blank::seekInLine($line);
        if ($exception) {
            $this->setExpectedException('InvalidArgumentException');
        }
        $tag = new TagAuthor($blank);
        if (!$exception) {
            $this->assertSame($name, $tag->getName());
            $this->assertSame($email, $tag->getEmail());
        }
    }

    /**
     * @return array
     */
    public function providerTag()
    {
        return [
            [
                '@author Vasa Pupkin <vasa@pupkin.loc>',
                'Vasa Pupkin',
                'vasa@pupkin.loc',
            ],
            [
                '@author Vasa Pupkin',
                'Vasa Pupkin',
                null,
            ],
            [
                '@author <vasa@pupkin.loc>',
                null,
                'vasa@pupkin.loc',
            ],
            [
                '@author  ',
                null,
                null,
            ],
            [
                '@link Vasa Pupkin',
                null,
                null,
                true,
            ],
        ];
    }
}
