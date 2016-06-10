<?php namespace CupOfTea\PHPSandbox\State;

use InvalidArgumentException;

abstract class AbstractState implements StateInterface
{
    /**
     * {@inheritdoc}
     */
    public static function fill($env = null, $constants = null, $variables = null)
    {
        return new static($env, $constant, $variables);
    }
    
    /**
     * {@inheritdoc}
     */
    final public function convertState($state)
    {
        $interfaces = class_implements($state);
        
        if ($interfaces && in_array(StateInterface::class)) {
            return $state::fill($this->getEnv(), $this->getConstants(), $this->getVariables());
        }
    }
}
