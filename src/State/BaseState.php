<?php namespace CupOfTea\PHPSandbox\State;

use InvalidArgumentException;

abstract class BaseState implements StateInterface
{
    /**
     * Validates an environment variable's name.
     * 
     * @param  string  $name
     *     
     * @throws \InvalidArgumentException when not valid.
     */
    protected function validateEnv($name)
    {
        if (! preg_match('/[A-Z_][A-Z0-9_]*/', $name)) {
            throw new InvalidArgumentException($name . ' is not a valid environment variable name.');
        }
    }
    
    /**
     * Validates a constant's name.
     * 
     * @param  string  $name
     *     
     * @throws \InvalidArgumentException when not valid.
     */
    protected function validateConstant($name)
    {
        if (! preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $name)) {
            throw new InvalidArgumentException($constant . ' is not a valid constant name.');
        }
    }
    
    /**
     * Validates a variable's name.
     * 
     * @param  string  $name
     *     
     * @throws \InvalidArgumentException when not valid.
     */
    protected function validateVariable($name)
    {
        if (! preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $name)) {
            throw new InvalidArgumentException($name . ' is not a valid variable name.');
        }
    }
}