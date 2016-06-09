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
     * The shell command to run the Sandbox.
     * 
     * @var \CupOfTea\PHPSandbox\Command\CommandInterface
     */
    private $cmd;
    
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
     * Execute a block of code in the Sandbox Environment.
     *
     * @param  closure  $code
     * @return mixed
     */
    public function exec(closure $code)
    {
        $this->prepareEnvironment();
        $this->bootstrap();
        $this->boot();
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
    
    protected function prepareEnvironment()
    {
        $cmd = $this->resetCommand();
        $cmd->setCommand('php');
    }
}
