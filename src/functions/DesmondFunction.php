<?php
namespace Desmond\functions;

interface DesmondFunction
{
    public function id();
    public function run(array $args);
}
