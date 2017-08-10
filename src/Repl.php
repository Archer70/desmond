<?php
namespace Desmond;
use Desmond\Desmond;
use Desmond\data_types\VoidType;

class Repl
{
    private $desmond;

    public function __construct()
    {
        $this->desmond = new Desmond();
    }

    public function start()
    {
        $this->welcome();
        do {
            $input = $this->promptForInput();

            if ($this->isExitCommand($input)) {
                exit("Later, guy.\n");
            }

            if ($this->shouldBeProcessed($input)) {
                try {
                    $return = $this->desmond->pretty(
                        $this->desmond->run($input));
                } catch (Exception $exception) {
                    echo "#! {$exception->getMessage()}\n";
                    continue;
                }
                echo $return . "\n";
            }
        } while (!feof(STDIN));
    }

    private function welcome()
    {
        echo "
Copyright 2017, Scott Christianson
Version 0.3.0
Welcome to Desmond's REPL.\n\n";
    }

    private function promptForInput()
    {
        echo '/user λ ';
        return fgets(STDIN);
    }

    private function isExitCommand($input)
    {
        return $input == "exit\n";
    }

    private function shouldBeProcessed($input)
    {
        return !empty($input) && !preg_match('/^;/', $input);
    }
}
