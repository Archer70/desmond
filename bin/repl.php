<?php
use Desmond\Lexer;
use Desmond\Evaluator;
use Desmond\data_types\VoidType;

$lexer = new Lexer();
$evaluator = new Evaluator();
$commands = [];
echo "
Copyright 2017, Scott Christianson
Version 0.1.0
Welcome to Desmond's REPL.\n\n";
do {
    echo '/user λ ';
    $input = fgets(STDIN);
    if ($input == "exit\n") {
        exit("Later, guy.\n");
    }
    if (!empty($input) && !preg_match('/^;/', $input)) {
        $commands[] = $input;
        try {
            $ast = $lexer->readString($input);
            $return = $evaluator->getReturn($ast);
        } catch (Exception $exception) {
            echo "#! {$exception->getMessage()}\n";
            continue;
        }
        echo $return instanceof VoidType ? "\n" : "#> $return\n";
    }
} while (!feof(STDIN));
