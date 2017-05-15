<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\HashType;
use Desmond\TypeHelper;
use Exception;

class DotPost implements DesmondFunction
{
    use TypeHelper;

    public function id()
    {
        return '.post';
    }

    public function run(array $args)
    {
        if (!isset($args[0])) {
            return self::fromPhpType($_POST);
        }
        $index = $args[0]->value();
        if (!isset($_POST[$index])) {
            throw new Exception('Index "' . $index . '" not found.');
        }
        return self::fromPhpType($_POST[$index]);
    }
}
