<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\functions\DocLibrary;
use Desmond\data_types\StringType;
use Desmond\exceptions\ArgumentException;

class Help extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'help';
    }

    public function run(array $args)
    {
        $this->expectFunction($args);
        $library = new DocLibrary();
        $library->index();
        if (!isset($library->library()[$args[0]->value()])) {
            throw new ArgumentException('"help": Function "' . $args[0]->value() . '" not found.');
        }
        $doc = $library->library()[$args[0]->value()];
        return self::formatHelpText($doc);
    }

    private function expectFunction($args)
    {
        $this->expectArguments(
            'help',
            [0 => ['String']],
            $args
        );
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
