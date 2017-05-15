<?php
namespace Desmond\functions;

class FileOperations
{
    public static function getDocFiles()
    {
        return self::getFilesInDirectory('docs');
    }

    public static function getFunctionFiles()
    {
        return self::getFilesInDirectory('core');
    }

    private static function getFilesInDirectory($dir)
    {
        $allFiles = scandir(__DIR__ . '/' . $dir);
        $files = [];
        foreach ($allFiles as $file) {
            if ($file == '.' || $file == '..' || !preg_match('/\.php$/', $file)) {
                continue;
            }
            $files[] = $file;
        }
        return $files;
    }
}
