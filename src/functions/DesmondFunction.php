<?php
namespace Desmond\functions;

interface DesmondFunction
{
    public static function id();
    public static function run(array $args);
}
