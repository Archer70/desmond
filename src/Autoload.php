<?php
namespace Desmond;
use Desmond\data_types\LambdaType;
use Desmond\data_types\SymbolType;

class Autoload
{
    private static $functions = [];

    public static function reset()
    {
        self::$functions = [];
    }

    public static function getLoadFunctions()
    {
        return self::$functions;
    }

    public static function register(LambdaType $lambda)
    {
        self::$functions[] = $lambda;
    }

    public static function run(SymbolType $symbol)
    {
        foreach (self::$functions as $function) {
            $function->run([$symbol]);
        }
    }
}
