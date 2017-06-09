<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\exceptions\ArgumentException;
use Desmond\ArgumentHelper;
use Desmond\functions\core\FileContents;
use Desmond\functions\core\Ast;
use Desmond\data_types\StringType;

class LoadFile extends DesmondSpecialFunction
{
    use ArgumentHelper;

    private $file;
    private $oldFilePath;
    private $oldDir;

    public function run(array $args)
    {
        if (!isset($args[0])) {
            throw new ArgumentException('"load-file" expects argument 1 to be one of (Symbol, String)');
        }
        $this->file = $this->eval->getReturn($args[0]);
        $this->updatePaths('new');
        $return = $this->eval->getReturn($this->getAst());
        $this->updatePaths('old');
        return $return;
    }

    private function getAst()
    {
        $ast = new Ast();
        return $ast->run([
            new StringType($this->getContents(), true)
        ]);
    }

    private function getContents()
    {
        $fileContents = new FileContents;
        $contents = $fileContents->run([$this->file]);
        return sprintf('(do %s)', $contents);
    }

    private function updatePaths($to)
    {
        if ($to == 'new') {
            $this->oldFilePath = $this->currentEnv->exists('_file')
                ? $this->currentEnv->get('_file')
                : new StringType('');
            $this->oldDir = $this->currentEnv->exists('_dir')
                ? $this->currentEnv->get('_dir')
                : new StringType('');
            $this->currentEnv->set('_file', new StringType($this->getFilePath()));
            $this->currentEnv->set('_dir', new StringType($this->getDir()));
        } else {
            $this->currentEnv->set('_file', $this->oldFilePath);
            $this->currentEnv->set('_dir', $this->oldDir);
        }
    }

    private function getDir()
    {
        return dirname(realpath($this->file->value()));
    }

    private function getFilePath()
    {
        return realpath($this->file->value());
    }
}
