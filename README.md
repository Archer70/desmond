# Desmond [![Build Status](https://travis-ci.org/Archer70/desmond.svg?branch=master)](https://travis-ci.org/Archer70/desmond) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Archer70/desmond/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Archer70/desmond/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/Archer70/desmond/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Archer70/desmond/?branch=master)
*Put some LISP in your PHP.*

## Goals
The basic idea here is to create small and fast LISP interpreter for PHP that focuses on functional programming, while also allowing interoperation with PHP itself. You should be able to add Desmond on top of an existing PHP code base, allowing lispy goodness that has access to the application it sits on. In other words, you could write a Wordpress mod in Desmond.

## Features

- Functional
- Immutable data types
- PHP interop
- PHP app integration
- Geared for the web
- Built in help text

## Installation

Globally with composer:

```bash
composer global require archer70/desmond
```

or per-project:

```bash
composer require archer70/desmond
```

## Development

Clone the repo

```bash
git clone https://github.com/Archer70/desmond.git
```

Install development dependencies (PHPUnit) and create autoloader.
```bash
composer install
```

Run the tests  
```bash
vendor/bin/phpunit -c phpunit.xml test/
```

## Help / Docs

For more information, including a quick start guide, see our [wiki pages](https://github.com/Archer70/desmond/wiki).

For information on specific functions, open a REPL and run `(function-list)` and `(help "function-name")`.

Also, feel free to drop by #desmond on Freenode if you require additional assistance, or if you're just bored.
