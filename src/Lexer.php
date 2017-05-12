<?php
namespace Desmond;
use Exception;
use Desmond\Reader;
use Desmond\Tokenizer;
use Desmond\data_types\ListType;
use Desmond\data_types\VectorType;
use Desmond\data_types\HashType;
use Desmond\data_types\SymbolType;
use Desmond\data_types\NumberType;
use Desmond\data_types\NilType;
use Desmond\data_types\TrueType;
use Desmond\data_types\FalseType;
use Desmond\data_types\StringType;

class Lexer
{
    private static $CONDITON = 0;
    private static $VALUE = 1;
    private $hashTokenIsKey = true;

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
                return $this->readCollection($reader, $collection, ')');
            case ')':
                throw new Exception('unexpected )');
            case '[':
                $reader->next();
                $collection = new VectorType();
                return $this->readCollection($reader, $collection, ']');
            case ']':
                throw new Exception('unexpected )');
            case '{':
                $reader->next();
                $hash = new HashType();
                return $this->readHash($reader, $hash);
            case '}':
                throw new Exception('unexpected }');
            default:
                $form = $this->readAtom($reader->peek());
                $reader->next();
                return $form;
        }
    }

    private function readCollection(Reader $reader, $collection, $end)
    {
        while (($token = $reader->peek()) !== $end) {
            if ($token === null) {
                throw new Exception('Expected "' . $end . '", found EOF.');
            }
            $collection->set($this->readForm($reader));
        }
        $reader->next();
        return $collection;
    }

    private function readHash(Reader $reader, $hash)
    {
        while (($token = $reader->peek()) !== '}') {
            if ($token === null) {
                throw new Exception('Expected "}", found EOF.');
            }
            $key = $this->readForm($reader);
            try {
                $value = $this->readForm($reader);
            } catch (Exception $exeption) {
                throw new Exception('Unexpected end of hash. Every key must have a value.');
            }
            $hash->set($value, $key->value());
        }
        $reader->next();
        return $hash;
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
            [preg_match('/^-?(\.?[0-9]+)|([0-9]+.[0-9]+)$/', $token), new NumberType($token)],
            [preg_match('/".*"/s', $token), new StringType($token)],
            [$token === 'nil', new NilType($token)],
            [$token === 'true', new TrueType($token)],
            [$token === 'false', new FalseType($token)],
            [true, new SymbolType($token)] // Basically, if it's nothing else, it's a symbol.
        ];
    }
}
