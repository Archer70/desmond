<?php
namespace Desmond\test\helpers;
use Desmond\data_types\NumberType;
use Desmond\data_types\VectorType;

trait NumberTrait
{
    function intType($number)
    {
        return new NumberType($number);
    }

    function intList(array $numbers, $vector=false)
    {
        $newNumbers = [];
        foreach ($numbers as $number) {
            $newNumbers[] = new NumberType($number);
        }
        if ($vector) {
            return new VectorType($newNumbers);
        }
        return $newNumbers;
    }
}
