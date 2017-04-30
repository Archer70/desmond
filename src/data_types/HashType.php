<?php
namespace Desmond\data_types;

class HashType extends AbstractCollection
{
    public function ends()
    {
        return ['{', '}'];
    }

    public function __toString()
    {
        $string = '';
        $first = true;
        foreach ($this->collection as $key => $val) {
            $separator = $first ? '' : ', ';
            $first = false;
            $string .= $separator. $key. ' '. $val->value();
        }
        return $this->ends()[0] . $string . $this->ends()[1];
    }
}
