<?php namespace CupOfTea\PHPSandbox\State;

use InvalidArgumentException;

class State implements StateInterface
{
    /**
     * Environment variables.
     * 
     * @var array
     */
    protected $env = [];
    
    /**
     * Constants.
     * 
     * @var array
     */
    protected $constants = [];
    
    /**
     * Variables.
     * 
     * @var array
     */
    protected $variables = [];
    
    /**
     * Create a new State instance.
     * 
     * @param  array  $env
     * @param  array  $constants
     * @param  array  $variables
     * @return void
     */
    public function __construct($env = null, $constants = null, $variables = null)
    {
        if (is_array($env)) {
            $this->env = $env;
        }
        
        if (is_array($constants)) {
            $this->constants = $constants;
        }
        
        if (is_array($variables)) {
            $this->variables = $variables;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function getEnv()
    {
        return $this->env;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setEnv($name, $value)
    {
        $this->validateEnv($name);
        
        $this->env[$name] = $value;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getConstants()
    {
        return $this->constants;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setConstant($name, $value)
    {
        $this->validateConstant($name);
        
        $this->constants[$name] = $value;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getVariables()
    {
        return $this->variables;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setVariable($name, $value)
    {
        $this->validateVariable($name);
        
        $this->variables[$name] = $value;
    }
}