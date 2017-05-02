<?php
use Desmond\Lexer;
use Desmond\Evaluator;
require_once __DIR__ . '/test/bootstrap.php';

class Desmond
{
    private $lexer;
    private $eval;

    public function __construct()
    {
        $this->lexer = new Lexer();
        $this->eval = new Evaluator();
    }

    public function run($command)
    {
        if (empty($command)) {
            return '';
        }
        try {
            $ast = $this->lexer->readString($command);
            $value = $this->eval->getReturn($ast);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
        return $value;
    }

    public function pretty($value)
    {
        return $value->__toString();
    }
}
