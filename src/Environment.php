<?php
namespace Desmond;
use Exception;

class Environment
{
    public $values = [];
    private $upperEnv = null;

    public function __construct(Environment $upperEnvironment=null)
    {
        $this->upperEnv = $upperEnvironment;
    }

    public function set($key, $val)
    {
        $this->values[$key] = $val;
    }

    public function get($key)
    {
        $envWithKey = $this->find($key);
        if (null !== $envWithKey) {
            return $envWithKey->values[$key];
        } else {
            throw new Exception('Symbol not found in environment.');
        }
    }

    public function find($key)
    {
        if (array_key_exists($key, $this->values)) {
            return $this;
        } else if (null !== $this->upperEnv) {
            return $this->upperEnv->find($key);
        } else {
            return null;
        }
    }
}
