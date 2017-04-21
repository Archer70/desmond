<?php
$commands = [];
do {
    echo 'user> ';
    $input = fgets(STDIN);
    if (!empty($input)) {
        $commands = $input;
        echo $input;
    }
} while (!feof(STDIN));