<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DotProperty implements Doc
{
    public function id()
    {
        return '.property';
    }

    public function synopsis()
    {
        return 'Gets or sets an object or class property.';
    }

    public function usage()
    {
        return '(.property <object/class:Object|Symbol|String> <property-name:Mixed> <?new-value:Mixed>)';
    }

    public function examples()
    {
        return [
            '(.property my-object my-property) ; Gets my-property on my-object.',
            '(.property my-object my-property "new value")',
            '(.property Classes\\MyClass static-property)'
        ];
    }
}