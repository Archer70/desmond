<?php
namespace Desmond\test\helpers;
use Desmond\Lexer;
use Desmond\Evaluator;

trait RunnerTrait
{
    function resultOf($string)
    {
        $lexer = new Lexer();
        $eval = new Evaluator();
        return $eval->getReturn(
            $lexer->readString($string));
    }

    function valueOf($string)
    {
        return $this->resultOf($string)->value();
    }
}
