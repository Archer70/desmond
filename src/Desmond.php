<?php

namespace Desmond;
use Desmond\test_framework\reporters\Dotty;

class Desmond
{
    const VERSION = '0.3.6';
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
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return $value;
    }

    public function loadFile($file)
    {
        $this->run('(load-file "' . $file . '")');
    }

    public function pretty($value)
    {
        return method_exists('__toString', $value) ? $value->__toString() : $value;
    }
}
