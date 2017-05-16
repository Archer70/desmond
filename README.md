# Desmond [![Build Status](https://travis-ci.org/Archer70/desmond.svg?branch=master)](https://travis-ci.org/Archer70/desmond) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Archer70/desmond/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Archer70/desmond/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/Archer70/desmond/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Archer70/desmond/?branch=master)
*Put some LISP in your PHP.*

## Goals
The basic idea here is to create small and fast LISP interpreter for PHP that focuses on functional programming, while also allowing interoperation with PHP itself. Theoretically, you could add Desmond on top of an existing PHP code base, allowing lispy goodness that has access to the application it sits on.

## Quick Start

If you have PHP installed locally, you can run `repl.php` in the project root for testing purposes.

### Types

**Numbers**
```clojure
; Whole numbers
7
; Floats
4.20
```

**Symbols**
```clojure
; Can contain a-z, 0-9, :, !, ?, -, _
my-symbol
```

**Strings**
```clojure
"My text string with \"quotes\" escaped."
```

**True, False, Nil**

```clojure
true
false
nil
```

**Vectors (numerically indexed arrays)**

```clojure
; Commas are optional and considered white space in Desmond.
[1 2 3 4]
```

**Hash (associative arrays)**
```clojure
{
    :symbol-key "value"
    "string-key" "value2"
}
```

**Lists (core structure of LISP and Desmond)**
```clojure
; First element is a function name unless otherwise specified.
(print-line "text string")
#> "text string"

; Raw list.
(list 1 2 3)
#> (1, 2, 3)
```

## Help
Open a REPL and run `(function-list)` and `(help function-name)` for more information.

Also, feel free to drop by #desmond on Freenode if you require additional assistance, or if you're just bored.
