<?php
namespace Desmond;
use Desmond\Reader;
use Desmond\Tokenizer;
use Desmond\data_types\Symbol;

class Lexer
{
    public function readString($string)
    {
        $tokens = Tokenizer::tokenize($string);
        if (empty($tokens)) {
            throw new \Exception('No code.');
        }
        $tree = $this->readForm(new Reader($tokens));
        return $tree;
    }

    public function readForm(Reader $reader)
    {
        $form = null;
        switch ($reader->peek()) {
            case '(':
                $form =  $this->readList($reader);
                break;
            case ')':
                throw new \Exception('unexpected )');
                break;
            default:
                $form = $this->readAtom($reader);
                break;
        }
        return $form;
    }

    public function readList(Reader $reader)
    {
        $syntaxTree = [];
        $reader->next();
        while (($token = $reader->peek()) !== ')') {
            if ($token === null) {
                throw new \Exception('expected ); got EOL.');
            }
            $syntaxTree[] = $this->readForm($reader);
        }
        $reader->next();
        return $syntaxTree;
    }

    public function readAtom(Reader $reader)
    {
        $token = $reader->peek();
        $reader->next();
        $tokenLiteral = null;
        if (preg_match('/^-?[0-9]+$/', $token)) {
            $tokenLiteral = (int) $token;
        } else if (preg_match('/^".*"$/', $token)) {
            $tokenLiteral = preg_replace(
                ['/^"|"$/', '/\\\"/', '/\\\n/'],
                ['', '"', "\n"],
                $token);
        } else if ($token === 'nil') {
            $tokenLiteral = null;
        } else if ($token === 'true') {
            $tokenLiteral = true;
        } else if ($token === 'false') {
            $tokenLiteral = false;
        } else {
            $tokenLiteral = new Symbol($token);
        }
        return $tokenLiteral;
    }
}