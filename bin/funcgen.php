#!/bin/php
<?php
use Desmond\Desmond;
require_once __DIR__ . '/../vendor/autoload.php';

$template = '<?php
namespace Desmond\\functions\\core;
use Desmond\\functions\\DesmondFunction;
use Desmond\\ArgumentHelper;

class %s implements DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return \'%s\';
    }

    public function run(array $args)
    {
        $this->expectArguments(
            \'%s\'
            [],
            []
        );
        $this->newReturnType(\'\', []);
    }
}';

echo "Class name: ";
$name = str_replace("\n", '', fgets(STDIN));

echo "Identifying symbol: ";
$id = str_replace("\n", '', fgets(STDIN));

$contents = sprintf($template, $name, $id, $id);
echo $contents;

echo "\n\n--------------------------------\n\nOkay? [y/n]: ";
$input = fgets(STDIN);
if ($input !== "y\n") {
    exit;
}
file_put_contents(__DIR__ . "/../src/functions/core/$name.php", $contents);

echo "Done.\n\n";
