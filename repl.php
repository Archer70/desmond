<?php
use Desmond\Lexer;
require_once __DIR__ . '/test/bootstrap.php';

$lexer = new Lexer();
$commands = [];
do {
    echo 'user> ';
    $input = fgets(STDIN);
    if (!empty($input)) {
        $commands[] = $input;
        print_r($lexer->readString($input));
    }
} while (!feof(STDIN));