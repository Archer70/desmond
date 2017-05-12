<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\functions\DocLibrary;
use Desmond\data_types\StringType;
use Exception;

class Help implements DesmondFunction
{
    public static function id()
    {
        return 'help';
    }

    public static function run(array $args)
    {
        $library = new DocLibrary();
        $library->index();
        if (!isset($args[0]) || !($args[0] instanceof StringType)) {
            throw new Exception('First argument must be a string containing the name of a function. See (function-list) for available functions.');
        }
        if (!isset($library->library()[$args[0]->value()])) {
            throw new Exception('Function "' . $args[0]->value() . '" not found.');
        }
        $doc = $library->library()[$args[0]->value()];
        return self::formatHelpText($doc);
    }

    private static function formatHelpText($doc)
    {
        $help = '';
        $help .= $doc->synopsis() . "\n";
        $help .= "Usage: {$doc->usage()}\n";
        $help .= "Examples:\n";
        foreach ($doc->examples() as $example) {
            $help .= "\t$example\n";
        }
        return new StringType($help);
    }
}
