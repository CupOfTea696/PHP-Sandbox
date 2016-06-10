<?php namespace CupOfTea\PHPSandbox\State;

interface StateInterface
{
    /**
     * Fill the state with environment variables, constants and variables.
     * 
     * @param  array|null  $env
     * @param  array|null  $constants
     * @param  array|null  $variables
     * @return \CupOfTea\PHPSandbox\State\StateInterface
     */
    public static function fill($env = null, $constants = null, $variables = null);
    
    /**
     * Get all environment variables.
     * 
     * @return array
     */
    public function getEnv();
    
    /**
     * Set an environment variable.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function setEnv($name, $value);
    
    /**
     * Get all constants.
     * 
     * @return array
     */
    public function getConstants();
    
    /**
     * Set a constant.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function setConstant($name, $value);
    
    /**
     * Get all variables.
     * 
     * @return array
     */
    public function getVariables();
    
    /**
     * Set a variable.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function setVariable($name, $value);
    
    /**
     * Convert a StateInterface implementation to another StateInterface implementation.
     * 
     * @param  \CupOfTea\PHPSandbox\State\StateInterface|string  $state
     * @return \CupOfTea\PHPSandbox\State\StateInterface
     */
    public function convertState($state);
}
