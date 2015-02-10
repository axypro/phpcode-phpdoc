# Annotation Classes

Classes of the annotations are located in the `axy\phpcode\phpdoc\annotations` namespace.

All parts of annotations are optional.
For an unspecified part returns `NULL`.

For example:

```
@author John <john@mail.loc>
@author Jack
```

For first author `$author->getEmail()` returns `john@mail.loc`.
For second author returns `NULL`.

## `Tag`

The base class.

Methods:

* `getTag(void):string`
* `getData(void):string|null`
* `getText(void):string|null`

Returns the tag, the data and the text of the annotation (see [annotation format](annotation-format.md)).

## `TagAuthor` for `@author`

Examples:

```
@author Name <email@mail.loc>
@author Name
@author <email@mail.loc>
```

Methods:

* `getName(void):string`
* `getEmail(void):string`

## `TagDeprecated` for `@deprecated`

Examples:

```
@deprecated 1.2.0 needlessly
@deprecated 1.2.0
@deprecated needlessly
@deprecated
```

Methods:

* `getVersion(void):string`
* `getDescription(void):string`

## `TagExample` for `@example`

Format of the content and new class methods are not defined.

## `TagInheritdoc` for `@inheritdoc`

Format of the content and new class methods are not defined.

## `TagLink` for `@link`

Examples:

```
@link http://example.loc/doc Documentation
@link https://example.loc/repo Repository
@link //example.loc/repo Repository
@link file:///etc/password Passwords
@link http://example.loc
@link the link
```

Methods:

* `getURI(void):string`
* `getDescription(void):string`

## `TagTodo` for `@todo`

Examples:

```
@todo {John} refactor it
@todo check John
@todo
```

Methods:

* `getUser(void):string`
* `getDescription(void):string`

## `TagBaseTyped`

The base class for annotations that contain type.
`@param`, `@return`, `@var`, `@property`, `@property-read` and `@property-write`

Methods:

* `getTypes(void):array`
* `getDescription(void):string`

Examples:

```
@return string description       // types: [string], description: "description"
@return string                   // description is NULL
@return (string|int) description // types: [string, int] 
```

## `TagReturn` for `@return`

`TagReturn` inherited from `TagBaseTyped` and does not define new methods.

```
@return string
@return (string|int) a string if A and int if B
```

## `TagThrows` for `@throws`

`TagThrows` inherited from `TagBaseTyped` and does not define new methods.

```
@throws \LogicException
@throws \RuntimeException wtf!! 
```

## `TagBaseVar`

Inherited from `TagBaseTypes`.
The base class for `@param`, `@var` and `@property-*`.

These annotations contains the name of the variable.

```
@property string $x description // types: [string], name: "x", description: "description"
```

Methods:

* `getName(void):string`

## `TagVar` for `@var`

`TagVar` inherited from `TagBaseVar` and does not define new methods.

```
@var string
@var string $x this is x
@var (string|\MyClass) this is var
```

## `TagParam` for `@param`

`TagParam` inherited from `TagBaseVar`.
Added the "optional" flag.

```
@param string $x
@param string
@param string $x an argument
@param string $x [optional] an argument
```

Methods:

* `isOptional(void):bool`

## `TagProperty` for `@property`, `@property-read` and `@property-write`

`TagVar` inherited from `TagBaseVar`.

```
@property string $x
@property-read (string|int) $y this is y
@property-write $z
```

Methods:

* `isWritable(void):bool`
* `isReadable(void):bool`
