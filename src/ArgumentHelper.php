<?php
namespace Desmond;
use Desmond\exceptions\ArgumentException;

trait ArgumentHelper
{
    public function expectArguments($function, array $expected, array $actual)
    {
        foreach ($expected as $argIndex => $types) {
            if (!isset($actual[$argIndex])) {
                $this->failException($function, $argIndex, $types);
            }
            $actualArg = $actual[$argIndex];
            $requiredTypes = $this->classPaths($types);
            if (!in_array(get_class($actualArg), $requiredTypes)) {
                $this->failException($function, $argIndex, $types);
            }
        }
        return true;
    }

    public function failException($function, $arg, $types)
    {
        if (count($types) > 1) {
            $message = sprintf(
                '"%s" expects argument %d to be one of [%s].',
                $function, $arg+1, implode(', ', $types));
        } else {
            $message = sprintf(
                '"%s" expects argument %d to be a %s.',
                $function, $arg+1, $types[0]);
        }
        throw new ArgumentException($message);
    }

    public function classPaths(array $types)
    {
        $paths = [];
        foreach ($types as $type) {
            $paths[] = $this->typeClassPath($type);
        }
        return $paths;
    }

    public function typeClassPath($type)
    {
        return 'Desmond\\data_types\\' . $type . 'Type';
    }

    public function isDesmondType($type, $object) {
        $class = $this->typeClassPath($type);
        return $object instanceof $class;
    }

    public function newReturnType($type, $arg=null)
    {
        $class = $this->typeClassPath($type);
        return $arg === null ? new $class() : new $class($arg);
    }
}
