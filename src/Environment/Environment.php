<?php namespace CupOfTea\PHPSandbox\Environment;

use CupOfTea\PHPSandbox\State\State;
use CupOfTea\PHPSandbox\State\NullState;
use CupOfTea\PHPSandbox\State\StateInterface;

class Environment
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
    
    public function save()
    {
        if ($this->env || $this->constants || $this->variables) {
            return new State($this->env, $this->constants, $this->variables);
        }
        
        return new NullState();
    }
    
    public function restore(StateInterface $state)
    {
        
    }
    
    protected function define()
    {
        $script = '';
        
        foreach ($this->constants as $constant => $value) {
            
        }
    }
    
    protected function assign()
    {
        $script = '';
        
        foreach ($this->variables as $variable => $value) {
            $script .= '$' . $variable . ' = deserialize(' . serialize($value) . ');';
        }
        
        return $script;
    }
}
