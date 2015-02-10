# Annotation Format

Annotation contains the following parts:
 
* The tag (necessarily)
* The data (optional)
* The text (optional)

Format:

```
@tag(data) text
```

```
@param string $x
```

`param` is the tag.
`string $x` is the text.

The text can be multiline.
Meaning of the text depends on the tag.

Standard annotations do not contain the data.
But custom annotations can contain it in the brackets.

```php
/**
 * @my\Annotation(x=1;y=2) text
 */
```

`x=1;y=2` is the data.
Meaning of the data depends on the tag.

See [list of the annotations](tags.md).