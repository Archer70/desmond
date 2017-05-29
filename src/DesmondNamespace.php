<?php
namespace Desmond;

class DesmondNamespace
{
    private static $root;
    private static $namespaces = [];

    public static function setRoot(Environment $env)
    {
        self::$root = $env;
    }

    public static function getRoot()
    {
        return self::$root;
    }

    public static function create($key, Environment $env)
    {
        self::$root->set($key, $env);
        self::$namespaces[$key] = $env;
    }

    public static function get($key)
    {
        return self::$namespaces[$key];
    }

    public static function exists($key)
    {
        return array_key_exists($key, self::$namespaces);
    }
}
