<?php
spl_autoload_register(function($class) {
    $class = str_replace(['\\', 'Desmond/'], ['/', ''], $class);
    $path = __DIR__ . "/../src/$class.php";
    if (file_exists($path)) {
        require $path;
    }
});