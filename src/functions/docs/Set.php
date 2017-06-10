<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Set implements Doc
{
    public function id()
    {
        return 'set';
    }

    public function synopsis()
    {
        return 'Sets a key/value pair on a Hash, and returns a new one as the result.';
    }

    public function usage()
    {
        return '(set <hash:Hash> <key:Number|Symbol|String> <value:Mixed>)';
    }

    public function examples()
    {
        return [
            '(set {} :key "value")'
        ];
    }
}
