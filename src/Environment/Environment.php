<?php namespace CupOfTea\PHPSandbox\Environment;

use CupOfTea\PHPSandbox\State\State;
use CupOfTea\PHPSandbox\State\StateInterface;

class Environment
{
    /**
     * Environment variables.
     * 
     * @var array
     */
    protected $env = [
        'env' => [],
        'sandbox' => [],
    ];
    
    /**
     * Constants.
     * 
     * @var array
     */
    protected $constants = [
        'env' => [],
        'sandbox' => [],
    ];
    
    /**
     * Variables.
     * 
     * @var array
     */
    protected $variables = [
        'env' => [],
        'sandbox' => [],
    ];
    
    /**
     * The Process.
     * 
     * @var \CupOfTea\PHPSandbox\Command\Process
     */
    protected $process;
    
    private $lastUpdate = 0;
    
    /**
     * Create a new Environment instance.
     * 
     * @param  \CupOfTea\PHPSandbox\State\StateInterface  $env
     * @return void
     */
    public function __construct(StateInterface $state = null)
    {
        if ($state) {
            $this->restore($state);
        }
    }
    
    public function setProcess(Process $process)
    {
        $this->process = $process;
        $this->lastUpdate = 0;
    }
    
    public function getEnv($name)
    {
        $this->refresh();
    }
    
    public function getEnvVariables()
    {
        $this->refresh();
    }
    
    public function setEnv($name, $value)
    {
        $this->operation(__FUNCTION__, $name, $value);
        $this->env['env'][$name] = $value;
    }
    
    public function issetEnv($name)
    {
        return array_key_exists($name, $this->env['env']) || array_key_exists($name, $this->env['sandbox']);
    }
    
    public function unsetEnv($name)
    {
        
    }
    
    public function getConstant($name)
    {
        
    }
    
    public function getConstants()
    {
        
    }
    
    public function setConstant($name, $value)
    {
        
    }
    
    public function setConstantIfNotSet($name, $value)
    {
        
    }
    
    public function issetConstant($name)
    {
        return array_key_exists($name, $this->constants['env']) || array_key_exists($name, $this->constants['sandbox']);
    }
    
    public function getVariable($name)
    {
        
    }
    
    public function getVariables()
    {
        
    }
    
    public function setVariable($name, $value)
    {
        
    }
    
    public function issetVariable($name)
    {
        return array_key_exists($name, $this->variables['env']) || array_key_exists($name, $this->variables['sandbox']);
    }
    
    public function unsetVariable($name)
    {
        
    }
    
    /**
     * Save the current Environment State.
     * 
     * @return \CupOfTea\PHPSandbox\State\State
     */
    public function save()
    {
        return new State($this->env, $this->constants, $this->variables);
    }
    
    /**
     * Restore a prvious Environment State.
     * 
     * @param  \CupOfTea\PHPSandbox\State\StateInterface  $state
     * @return void
     */
    public function restore(StateInterface $state)
    {
        $this->env = $state->getEnv();
        $this->constants = $state->getConstants();
        $this->variablse = $state->getVariables();
    }
}
