<?php
namespace Desmond;
use Desmond\Reader;
use Desmond\Tokenizer;

class Lexer
{
    public function readString($string)
    {
        $tokens = Tokenizer::tokenize($string);
        if (empty($tokens)) {
            throw new \Exception('No code.');
        }
        $this->readForm(new Reader($tokens));
    }

    public function readForm(Reader $reader)
    {
        switch ($reader->peek())
        {
            case '(':
                $this->readList($reader);
                break;
            default:
                $this->readAtom($reader);
                break;
        }
    }

    public function readList(Reader $reader)
    {
        $lists = [];
        while($reader->peek() !== ')') {
            $reader->next();
            $lists[] = $this->readForm($reader);
        }
        return $lists;
    }

    public function readAtom(Reader $reader)
    {

    }
}