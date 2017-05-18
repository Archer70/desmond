<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\HashType;
use Desmond\TypeHelper;
use Desmond\exceptions\ArgumentException;

class DotGet extends DesmondFunction
{
    use TypeHelper;

    public function id()
    {
        return '.get';
    }

    public function run(array $args)
    {
        if (!isset($args[0])) {
            return self::fromPhpType($_GET);
        }
        $index = $args[0]->value();
        if (!isset($_GET[$index])) {
            throw new ArgumentException('".get": Index "' . $index . '" not found.');
        }
        return self::fromPhpType($_GET[$index]);
    }
}
