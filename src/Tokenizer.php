<?php
namespace Desmond;

class Tokenizer
{
    public static function tokenize($code)
    {
        $pattern = "/[\s,]*(~@|[\[\]{}()'`~^@]|\"(?:\\\\.|[^\\\\\"])*\"|;.*|[^\s\[\]{}('\"`,;)]*)/";
        preg_match_all($pattern, $code, $matches);
        self::removeTrailer($matches[1]);
        return $matches[1];
    }

    private static function removeTrailer(&$matches)
    {
        array_pop($matches);
        if (count($matches) === 1 && empty($matches[0])) {
            $matches = [];
        }
    }
}