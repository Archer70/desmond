<?php
namespace Desmond\functions;

interface Doc
{
    public function id();
    public function synopsis();
    public function usage();
    public function examples();
}
