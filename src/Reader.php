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
        return $this;
    }

    public function peek()
    {
        return $this->characters[$this->position] ?? null;
    }

    public function hasNext()
    {
        return isset($this->characters[$this->position + 1]);
    }
}
