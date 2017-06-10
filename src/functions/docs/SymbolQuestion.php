<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class SymbolQuestion implements Doc
{
    public function id()
    {
        return 'symbol?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is a Symbol, otherwise FALSE.';
    }

    public function usage()
    {
        return '(symbol? <argument:Mixed>)';
    }

    public function examples()
    {
        return [
            '(symbol? my-sym)'
        ];
    }
}