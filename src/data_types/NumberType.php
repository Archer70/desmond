<?php
namespace Desmond\data_types;

class NumberType extends AbstractAtom
{
    public function __construct($token)
    {
        $token = strpos($token, '.') || is_float($token) ? (float) $token : (int) $token;
        $this->setValue($token);
    }
}
