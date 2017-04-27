<?php
namespace Desmond\data_types;

class HashType extends AbstractCollection
{
    public function ends()
    {
        return ['{', '}'];
    }
}
