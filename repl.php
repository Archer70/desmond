<?php
use Desmond\Lexer;
use Desmond\Evaluator;
require_once __DIR__ . '/test/bootstrap.php';

$lexer = new Lexer();
$evaluator = new Evaluator();
$commands = [];
do {
    echo 'user> ';
    $input = fgets(STDIN);
    if (!empty($input)) {
        $commands[] = $input;
        $ast = $lexer->readString($input);
        print_r($ast);
        $return = $evaluator->getReturn($ast);
        echo "#> {$return->value()}\n";
    }
} while (!feof(STDIN));
