<?php
namespace Desmond\functions;

class DocLibrary
{
    private $library = [];

    public function index()
    {
        foreach (FileOperations::getDocFiles() as $file) {
            $class = sprintf('Desmond\\functions\\docs\\%s', substr($file, 0, -4));
            $doc = new $class;
            $this->library[$doc->id()] = $doc;
        }
    }

    public function library()
    {
        return $this->library;
    }
}
