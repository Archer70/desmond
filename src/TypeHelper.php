<?php
namespace Desmond;
use Exception;
use Desmond\data_types\StringType;
use Desmond\data_types\NumberType;
use Desmond\data_types\VectorType;
use Desmond\data_types\HashType;
use Desmond\data_types\NilType;
use Desmond\data_types\TrueType;
use Desmond\data_types\FalseType;

trait TypeHelper {
    static function fromPhpType($value)
    {
        if (is_null($value)) {
            return new NilType();
        } else if (is_string($value)) {
            return new StringType($value);
        } else if (is_int($value) || is_float($value)) {
            return new NumberType($value);
        } else if (is_bool($value)) {
            return $value === true ? new TrueType($value) : new FalseType($value);
        } else if (is_array($value)) {
            foreach (array_keys($value) as $key) {
                if (is_string($key)) {
                    return new HashType($value);
                }
            }
            return new VectorType($value);
        } else {
            throw new Exception('Unidentified PHP type.');
        }
    }
}
