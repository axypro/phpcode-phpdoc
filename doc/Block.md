# Class `Block`

The base class for parsing phpdoc-comments.

Example:

```php
use axy\phpcode\phpdoc\Block;

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

$block = new Block($comment);
echo $block->getTitle(); // MyClass
```

### Constructor

```
__construct(string $text)
```

The constructor takes the original comment.
 
```php
$block = new Block('/** @deprecated */);
```

### `getOriginalText(void):string`

Returns the original text of the comment.

### `getNormalizedText(void):string`

Returns the normalized text of the comment.
For the example:

```
My Class

The description of the class

@author Me
@todo refactoring
@property-read string $name
               an instance name
```

### `getPartText([bool $asArray = FALSE]):string|array`

Returns the text part of the block.

```
My Class

The description of the class
```

If specified `$asArray` then return an array of the lines.
By default return a string.

### `getPartAnnotation([bool $asArray = FALSE]):string|array`

Returns the annotation part of the block.

```
@author Me
@todo refactoring
@property-read string $name
               an instance name
```

If specified `$asArray` then return an array of the lines.
By default return a string.

### `getTitle(void):string|null`

Returns the block title.
In the example it is `My Class`.
If the title is not specified then returns `NULL`

### getDescription(void):string|null`

Returns the block description.
In the example it is `The description of the class`.
If the description is not specified then returns `NULL`.

### `getAnnotations([string|array $filter = null]):Tag[]`

Returns a list of annotation objects.
For annotation used base class [Tag](tags.md) (not specific classes as `TagAuthor` and etc).

For the example returns list of the following annotations: `@author`, `@todo`, `@property-read`.

```php
echo $block->getAnnotations()[1]->getTag(); // todo
```

The list can be filtered:

```php
$authors = $this->getAnnotations('author');
$properties = $this->getAnnotations(['property', 'property-read', 'property-write']);
```
