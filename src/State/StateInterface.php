<?php namespace CupOfTea\PHPSandbox\State;

interface StateInterface
{
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
    public function getConstant();
    
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
}
