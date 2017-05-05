<?php
namespace Desmond\test\helpers;
use Desmond\data_types\NumberType;

trait NumberTrait
{
    function intType($number)
    {
        return new NumberType($number);
    }

    function intList(array $numbers)
    {
        $newNumbers = [];
        foreach ($numbers as $number) {
            $newNumbers[] = new NumberType($number);
        }
        return $newNumbers;
    }
}
