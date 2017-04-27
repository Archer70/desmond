<?php
namespace Desmond\data_types;
use Desmond\data_types\AbstractCollection;

class ListType extends AbstractCollection
{    
    public function getFunction()
    {
        return $this->collection[0];
    }

    public function getArgs()
    {
        return $this->rest(); // Effectively does the same thing.
    }
}
