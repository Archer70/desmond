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
        try {
            $ast = $lexer->readString($input);
            $return = $evaluator->getReturn($ast)->value();
        } catch (Exception $exception) {
            echo "#! {$exception->getMessage()}\n";
            continue;
        }
        echo "#> {$return}\n";
    }
} while (!feof(STDIN));
