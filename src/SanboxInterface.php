<?php namespace CupOfTea\PHPSandbox;

use CupOfTea\PHPSandbox\State\StateInterface;

interface SandboxInterface
{
    /**
     * Execute a block of code in the Sandbox Environment.
     *
     * @param  closure  $code
     * @return mixed
     */
    public function exec(closure $code);
    
    /**
     * Run a PHP script in the Sandbox Environment.
     *
     * @param  string  $script
     * @return string
     */
    public function run($script);
    
    /**
     * Get an environment variable from the current Sandbox State.
     *
     * @param  string  $name
     * @return mixed
     */
    public function getEnv($name);
    
    /**
     * Set an environment variable in the Sandbox Environment.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function setEnv($name, $value);
    
    /**
     * Get aa constant from the current Sandbox State.
     *
     * @param  string  $script
     * @return mixed
     */
    public function getDefinition($name);
    
    /**
     * Set a constant in the Sandbox Environment.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function define($name, $value);
    
    /**
     * Check if a constant is set in the Sandbox Environment.
     *
     * @param  string  $name
     * @return void
     */
    public function defined($name);
    
    /**
     * Set a constant in the Sandbox Environment if it is not yet set.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function defineIfNotDefined($name, $value);
    
    /**
     * Save the current Sandbox State.
     *
     * @return \CupOfTea\PHPSandbox\State\StateInterface
     */
    public function saveState();
    
    /**
     * Restore a saved Sandbox State.
     *
     * @param  \CupOfTea\PHPSandbox\State\StateInterface  $state
     * @return void
     */
    public function restoreState(StateInterface $state);
    
    /**
     * Get a variable from the Sandbox Environment.
     *
     * @return mixed
     */
    public function __get($variable);
    
    /**
     * Set a variable in the Sandbox Environment.
     *
     * @return void
     */
    public function __set($variable, $value = null);
    
    /**
     * Check if a variable is set in the Sandbox Environment.
     *
     * @return void
     */
    public function __isset($variable);
    
    /**
     * Unset a variable in the Sandbox Environment.
     *
     * @return void
     */
    public function __unset($variable);
    
    /**
     * Call a function in the Sandbox Environment.
     *
     * @param  string  $method
     * @param  array  $args
     * @return mixed
     */
    public function __call($method, $args = []);
}
