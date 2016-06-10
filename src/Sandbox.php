<?php namespace CupOfTea\PHPSandbox;

use CupOfTea\Package\Package;
use InvalidArgumentException;

class Sandbox implements SandboxInterface
{
    use Package;
    
    /**
     * Package Name.
     *
     * @const string
     */
    const PACKAGE = 'CupOfTea/PHP-Sandbox';
    
    /**
     * Package Version.
     *
     * @const string
     */
    const VERSION = '0.0.0';
    
    /**
     * The Sandbox bootstrap file.
     *
     * @var string
     */
    protected $bootstrap;
    
    /**
     * The process running the Sandbox.
     * 
     * @var \CupOfTea\PHPSandbox\Command\Process
     */
    private $process;
    
    private $environment;
    
    /**
     * Create a new Sandbox instance.
     *
     * @param  string|null  $bootstrap
     * @return void
     *
     * @throws \InvalidArgumentException when the bootstrap path is invalid.
     */
    public function __construct($bootstrap = null)
    {
        if (! is_null($bootstrap)) {
            $this->validateFile($bootstrap);
            
            $this->bootstrap = $bootstrap;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function exec(closure $code)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function run($script)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function getEnv($name)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function setEnv($name, $value)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDefinition($name)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function define($name, $value)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function defined($name)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function defineIfNotDefined($name, $value)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function saveState()
    {
        return $this->environment->save();
    }
    
    /**
     * {@inheritdoc}
     */
    public function restoreState(StateInterface $state)
    {
        $this->environment->restore($state);
    }
    
    /**
     * {@inheritdoc}
     */
    public function __get($variable)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function __set($variable, $value = null)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function __isset($variable)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function __unset($variable)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function __call($method, $args = [])
    {
        
    }
    
    /**
     * Validates a file path.
     *
     * @param  string  $file
     * @return void
     *
     * @throws \InvalidArgumentException when the file path is invalid.
     */
    protected function validateFile($file)
    {
        if (! file_exists($file)) {
            throw new InvalidArgumentException('The path ' . $file . ' could not be found.');
        }
        
        if (is_dir($file)) {
            throw new InvalidArgumentException('The path ' . $file . ' is a directory.');
        }
    }
}
