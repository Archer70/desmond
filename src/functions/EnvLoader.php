<?php
namespace Desmond\functions;
use Desmond\Environment;

class EnvLoader
{
    public static function loadInto(Environment $env, $functionDir)
    {
        foreach (self::functionFiles($functionDir) as $file) {
            $class = sprintf('Desmond\\functions\\%s\\%s',
                $functionDir, substr($file, 0, -4));
            $function = new $class;
            $env->set($function->id(), $class);
        }
    }

    public static function functionFiles($dir)
    {
        $allFiles = scandir(__DIR__ . '/' . $dir);
        $files = [];
        foreach ($allFiles as $file) {
            if (self::notFunctionFile($file)) {
                continue;
            }
            $files[] = $file;
        }
        return $files;
    }

    private static function notFunctionFile($file)
    {
        return $file == '.' || $file == '..' || !preg_match('/\.php$/', $file);
    }
}
