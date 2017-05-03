<?php
namespace Desmond\test\helpers;
use Desmond\data_types\IntegerType;

trait NumberTrait
{
    function intType($number)
    {
        return new IntegerType($number);
    }

    function intList(array $numbers)
    {
        $newNumbers = [];
        foreach ($numbers as $number) {
            $newNumbers[] = new IntegerType($number);
        }
        return $newNumbers;
    }
}
