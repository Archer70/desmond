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
            throw new Exception('Symbol "' . $key . '" not found in environment.');
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

    public function makeChild()
    {
        $newEnvId = Environment::getNewEnvId($this->values);
        $newEnv = new Environment($this);

        $this->set($newEnvId, $newEnv);
        return $newEnvId;
    }

    public function getParent()
    {
        return $this->upperEnv;
    }

    public function destroyChild($child)
    {
        unset($this->values[$child]);
    }

    public static function getNewEnvId($values)
    {
        do {
            $envId = 'let_' . mt_rand(); // Most probably, this will only happen once.
        } while (array_key_exists($envId, $values));
        return $envId;
    }
}
