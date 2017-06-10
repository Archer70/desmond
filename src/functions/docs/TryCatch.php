<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class TryCatch implements Doc
{
    public function id()
    {
        return 'try';
    }

    public function synopsis()
    {
        return 'Try something and catch any exceptions it might throw.';
    }

    public function usage()
    {
        return '(try <code:Mixed> <catch:List>)';
    }

    public function examples()
    {
        return [
            '
(try
  (some-stuff)
  (catch :error-message
    (print-line :error-message))
)'
        ];
    }
}
