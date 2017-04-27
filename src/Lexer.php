<?php
namespace Desmond;
use Exception;
use Desmond\Reader;
use Desmond\Tokenizer;
use Desmond\data_types\ListType;
use Desmond\data_types\SymbolType;
use Desmond\data_types\IntegerType;
use Desmond\data_types\NilType;
use Desmond\data_types\TrueType;
use Desmond\data_types\FalseType;
use Desmond\data_types\StringType;

class Lexer
{
    private static $CONDITON = 0;
    private static $VALUE = 1;

    public function readString($string)
    {
        $tokens = Tokenizer::tokenize($string);
        if (empty($tokens)) {
            return null;
        }
        return $this->readForm(new Reader($tokens));
    }

    private function readForm(Reader $reader)
    {
        switch ($reader->peek()) {
            case '(':
                $reader->next();
                $collection = new ListType();
                return $this->readList($reader, $collection);
                break;
            case ')':
                throw new Exception('unexpected )');
                break;
            default:
                $form = $this->readAtom($reader->peek());
                $reader->next();
                return $form;
                break;
        }
    }

    private function readList(Reader $reader, $collection)
    {
        while (($token = $reader->peek()) !== ')') {
            if ($token === null) {
                throw new Exception('Expected ")", found EOL.');
            }
            $collection->set($this->readForm($reader));
        }
        $reader->next();
        return $collection;
    }

    private function readAtom($token)
    {
        $tokenLiteral = null;
        foreach ($this->tokenTestList($token) as $test) {
            if ($test[self::$CONDITON]) {
                $tokenLiteral = $test[self::$VALUE];
                break;
            }
        }
        return $tokenLiteral;
    }

    private function tokenTestList($token)
    {
        return [
            [preg_match('/^-?[0-9]+$/', $token), new IntegerType($token)],
            [preg_match('/^".*"$/', $token), new StringType($token)],
            [$token === 'nil', new NilType($token)],
            [$token === 'true', new TrueType($token)],
            [$token === 'false', new FalseType($token)],
            [true, new SymbolType($token)] // Basically, if it's nothing else, it's a symbol.
        ];
    }
}
