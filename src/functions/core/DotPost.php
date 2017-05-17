<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\HashType;
use Desmond\TypeHelper;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class DotPost implements DesmondFunction
{
    use TypeHelper;
    use ArgumentHelper;

    public function id()
    {
        return '.post';
    }

    public function run(array $args)
    {
        if (!isset($args[0])) {
            return self::fromPhpType($_POST);
        }
        $this->expectArguments(
            '.post',
            [0 => ['Symbol', 'String']],
            $args
        );
        $index = $args[0]->value();
        if (!isset($_POST[$index])) {
            throw new ArgumentException('".post": Index "' . $index . '" not found.');
        }
        return self::fromPhpType($_POST[$index]);
    }
}
