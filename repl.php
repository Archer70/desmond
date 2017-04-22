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
        $return = $evaluator->getReturn($lexer->readString($input))->value();
        echo "#> $return\n";
    }
} while (!feof(STDIN));
