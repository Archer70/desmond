#!/bin/php
<?php
use Desmond\Desmond;
require_once __DIR__ . '/../vendor/autoload.php';

if (isset($argv[1]) && ($argv[1] == '-u' || $argv[1] == '--undocumented')) {
    $docs = scandir(__DIR__ . '/../src/functions/docs');
    $functions = scandir(__DIR__ . '/../src/functions/core');
    print_r(array_diff($functions, $docs));
    exit;
}

$template = '<?php
namespace Desmond\\functions\docs;
use Desmond\\functions\\Doc;

class %s implements Doc
{
    public function id()
    {
        return \'%s\';
    }

    public function synopsis()
    {
        return \'%s\';
    }

    public function usage()
    {
        return \'%s\';
    }

    public function examples()
    {
        return [
            %s
        ];
    }
}';

echo "Class name: ";
$name = str_replace("\n", '', fgets(STDIN));

echo "Identifying symbol: ";
$id = str_replace("\n", '', fgets(STDIN));

echo "Synopsis: ";
$synopsis = str_replace("\n", '', fgets(STDIN));

echo "Usage: ";
$usage = str_replace("\n", '', fgets(STDIN));

$examples = [];
while (true) {
    echo "Example (leave empty to continue): ";
    $example = str_replace("\n", '', fgets(STDIN));;
    if (empty($example)) {
        break;
    }
    $examples[] = "'$example'";
}
$examples = implode(",\n            ", $examples);

$contents = sprintf($template, $name, $id, $synopsis, $usage, $examples);
echo $contents;

echo "\n\n--------------------------------\n\nOkay? [y/n]: ";
$input = fgets(STDIN);
if ($input !== "y\n") {
    exit;
}
file_put_contents(__DIR__ . "/../src/functions/docs/$name.php", $contents);

echo "Done. Here are the results of (help \"$id\")\n\n";

$desmond = new Desmond();
echo $desmond->pretty($desmond->run("(help \"$id\")"));
