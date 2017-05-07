<?php
namespace Desmond\functions;

class FileOperations
{
    public static function getDocFiles()
    {
        $allFiles = scandir(__DIR__ . '/docs');
        $files = [];
        foreach ($allFiles as $file) {
            if ($file == '.' || $file == '..' || !preg_match('/\.php$/', $file)) {
                continue;
            }
            $files[] = $file;
        }
        return $files;
    }

    public static function getFunctionFiles()
    {
        $allFiles = scandir(__DIR__ . '/core');
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
