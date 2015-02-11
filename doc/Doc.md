# Class  `Doc`

Class Doc extends [Block](Block.md).

This is the base class for phpdoc-blocks of specific items (classes, methods, properties).

List of annotations that are allowed for all items:

* @author
* @deprecated (single)
* @example
* @inheritdoc (single)
* @link
* @todo

Methods:

* `getAuthors(void):TagAuthor[]`
* `getDeprecated(void):TagDeprecated|null`
* `isDeprecated(void):bool`
* `getExamples(void):TagExample[]`
* `getInheritdoc(void):TagInheritdoc|null`
* `isInherit(void):bool`
* `getLinks(void):TagLink[]`
* `getTodoList(void):TagTodo[]`

Example:

```php
use axy\phpcode\phpdoc\Doc;

/**
 * My Class
 *
 * The description of the class
 *
 * @author Me
 * @todo refactoring
 * @property-read string $name
 *                an instance name
 */
class MyClass
{
    // ...
}

$rc = new \ReflectionClass('MyClass');
$comment = $rc->getDocComment();

$doc = new Doc($comment);
echo $doc->getAuthors()[0]->getName(); // Me
$doc->isDeprecated(); // FALSE
```
