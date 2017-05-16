<?php
namespace Desmond\data_types;

class StringType extends AbstractAtom
{
    public function __construct($token, $dontFormat=false)
    {
        if ($dontFormat) {
            $this->setValue($token);
            return;
        }
        $this->setValue($this->formatLiteralString($token));
    }

    private function formatLiteralString($string)
    {
        $searches = [
            '/^"|"$/', // Opening and closing quotes.
            '/\\\"/', // Quotes preceeded by backslash (\")
            '/\\\n/' // New lines (\n)
        ];
        $replaces = ['', '"', "\n"];
        return preg_replace($searches, $replaces , $string);
    }
}
