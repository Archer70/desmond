<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Autoload implements Doc
{
    public function id()
    {
        return 'autoload';
    }

    public function synopsis()
    {
        return 'Registers and autoload lambda function to be run whenever a namespaced symbol is looked up.';
    }

    public function usage()
    {
        return '(autoload <function:Lambda>)';
    }

    public function examples()
    {
        return [
            '(autoload (lambda [symbol] (load-file symbol)))'
        ];
    }
}