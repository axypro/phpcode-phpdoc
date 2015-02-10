# PHPDoc Block Format

A block begins with `/**` and ends with `*/`.
Each line can begin with `*` for beauty.

Example 1.

```php
/**
 * The method
 *
 * No one knows what makes this method.
 * Probably nothing.
 *
 * @param (string|int) $one
 *        a first argument
 * @param int $two [optional]
 *        a second argument
 * @return mixed
 *         the result
 */
```

Example 2.

```php
/** @deprecated */
```

Block contains three sections:

* The title
* The description
* The list of annotations

All these sections are optional.
In first example:

* The title: `The method`
* The description: `No one knows...nothing.`
* The annotations: @param, @param and @return

In second example the title and the description are empty.

## Normalization

Original comment is processed as follows:

1. Remove leading `/**` and trailing `*/`.
2. For each line remove final spaces.
3. If first non-space character of line is `*` then remove it and leading spaces (but no spaces after `*`).
4. For each non-empty line determine the size of the indentation. Calculate the minimum. Shift all lines.
5. Remove all empty line from the begin and the end.

The result for the example 1:

```
The method

No one knows what makes this method.
Probably nothing.

@param (string|int) $one
       a first argument
@param int $two [optional]
       a second argument
@return mixed
        the result
```

## Annotations

Take into consideration annotation in the line begin only (given the spaces).

```php
/**
 * The title
 * Description. @example file.php
 *
 * @param string $x
 *        @see methodTwo
 */
```

There is only one annotation: `@param`.
`@example` is the part of the description.
`@see` is the part of the `@param` content.

Inline annotation (such as `{@see ..}`) are not taken into consideration.
Except `{@inheritdoc}` in the beginning of the line.

```php
/**
 * {@inheritdoc}
 */
```

The content of the annotation is all text until the next annotation or until the end of the block.
Trailing spaces of the annotation content are cut.

See [annotation format](annotation-format.md).

## Title and Description

The title is single line.
The description can be multiline.

If the first line of the block is not an annotation then this is the title.
All the following lines (down to the first annotation) are description.
The description maybe separated by empty lines, or maybe not.

```php
/**
 * The title.
 * The description.
 * @annotation
 */
```

The format of titles and descriptions is indifferent to the library.
It may be plain text, markdown with inline annotations and etc.
The library returns plain text.
