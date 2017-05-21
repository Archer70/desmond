<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\data_types\VectorType;
use Desmond\exceptions\ArgumentException;
use RuntimeException;
use ArgumentCountError;

class DotFunc extends DesmondFunction
{
    use ArgumentHelper;
    public function id()
    {
        return '.func';
    }

    public function run(array $args)
    {
        $this->expectArguments(
            '.func',
            [0 => ['Symbol', 'String']],
            $args
        );
        $function = self::getFunction($args);
        $args = self::getArgs($args);

        // This is to capture warnings when you call PHP functions without all their args.
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            throw new RuntimeException($errstr);
        });

        try {
            $value = $function(...$args);
        } catch (RuntimeException $error) {
            throw new ArgumentException("\".func\": Too few arguments passed to $function.");
        } catch (ArgumentCountError $error) {
            throw new ArgumentException("\".func\": Too few arguments passed to $function.");
        }
        restore_error_handler();
        return $value;
    }

    private static function getArgs($args)
    {
        array_shift($args);
        $argValues = [];
        foreach ($args as $arg) {
            $argValues[] = $arg->value();
        }
        return $argValues;
    }

    private static function getFunction(array $args)
    {
        $functionName = $args[0]->value();
        if (!function_exists($functionName)) {
            throw new ArgumentException("\".func\": undefined PHP function \"$functionName\".");
        } else {
            return $args[0]->value();
        }
    }
}
