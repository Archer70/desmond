<?php
namespace Desmond\functions;

class DocLibrary
{
    private $library = [];

    public function index()
    {
        foreach (self::docFiles() as $file) {
            $class = sprintf('Desmond\\functions\\docs\\%s', substr($file, 0, -4));
            $doc = new $class;
            $this->library[$doc->id()] = $doc;
        }
    }

    public function library()
    {
        return $this->library;
    }

    private function docFiles()
    {
        $allFiles = scandir(__DIR__ . '/docs');
        $files = [];
        foreach ($allFiles as $file) {
            if ($file == '.' || $file == '..' || !preg_match('/\.php$/', $file)) {
                continue;
            }
            $files[] = $file;
        }
        return $files;
    }
}
