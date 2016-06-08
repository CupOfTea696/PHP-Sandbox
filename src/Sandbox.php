<?php namespace CupOfTea\PHPSandbox;

use InvalidArgumentException;

class Sandbox implements SandboxInterface
{
    protected $bootstrap;
    
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
