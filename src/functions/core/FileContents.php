<?php
namespace Desmond\functions\core;
use Desmond\exceptions\ArgumentException;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\data_types\StringType;

class FileContents extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'file-contents';
    }

    public function run(array $args)
    {
        $this->expectFile($args);
        $path = $args[0];
        if (!file_exists($path)) {
            throw new ArgumentException('"file-contents": File not found.');
        }
        $contents = file_get_contents($path);
        return new StringType($contents, true);
    }

    public function expectFile($args)
    {
        $this->expectArguments(
            'file-contents',
            [0 => ['Symbol', 'String']],
            $args
        );
    }
}
