<?php
namespace Desmond;
use Exception;
use Desmond\data_types\ObjectType;
use Desmond\data_types\StringType;
use Desmond\data_types\NumberType;
use Desmond\data_types\VectorType;
use Desmond\data_types\HashType;
use Desmond\data_types\NilType;
use Desmond\data_types\TrueType;
use Desmond\data_types\FalseType;

trait TypeHelper {
    public static function fromPhpType($value)
    {
        if (is_null($value)) {
            return new NilType();
        } else if (is_string($value)) {
            return new StringType($value);
        } else if (is_int($value) || is_float($value)) {
            return new NumberType($value);
        } else if (is_bool($value)) {
            return $value === true ? new TrueType() : new FalseType();
        } else if (is_array($value)) {
            foreach ($value as $key => $data) {
                $value[$key] = self::fromPhpType($data);
            }
            // Is associative?
            if (count(array_filter(array_keys($value), 'is_string')) > 0) {
                return new HashType($value);
            } else {
                return new VectorType($value);
            }
        } else if (is_object($value)) {
            return new ObjectType($value);
        } else {
            throw new Exception('Unknown PHP type.');
        }
    }
}
