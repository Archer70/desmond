<?php
namespace Desmond;

class Reader
{
    private $position = 0;
    private $characters;

    public function __construct(array $characters)
    {
        $this->characters = $characters;
    }

    public function next()
    {
        $this->position++;
    }

    public function peek()
    {
        return $this->characters[$this->position];
    }
}