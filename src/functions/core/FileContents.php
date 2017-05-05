<?php
namespace Desmond\functions\core;
use Exception;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\StringType;

class FileContents implements DesmondFunction
{
    public static function id()
    {
        return 'file-contents';
    }

    public static function run(array $args)
    {
        $path = $args[0];
        if (!file_exists($path)) {
            throw new Exception('File not found.');
        }
        $contents = file_get_contents($path);
        return new StringType($contents);
    }
}
