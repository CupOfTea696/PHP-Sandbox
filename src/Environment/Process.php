<?php namespace CupOfTea\PHPSandbox\Environment;

use RuntimeException;

class Process
{
    const STDIN  = 0;
    const STDOUT = 1;
    const STDERR = 2;
    
    /**
     * Command to start the process.
     * 
     * @var string
     */
    protected $command;
    
    /**
     * Environment variables.
     * 
     * @var array
     */
    protected $env;
    
    /**
     * Skip over the first n lines when the process opens.
     * 
     * @var int
     */
    protected $skipLines;
    
    /**
     * Process descriptors.
     * 
     * @var array
     */
    protected $descriptors = [
        self::STDIN => ['pipe', 'r'],
        self::STDOUT => ['pipe', 'w'],
        self::STDERR => ['pipe', 'w'],
    ];
    
    /**
     * Process pipes.
     * 
     * @var array
     */
    protected $pipes;
    
    /**
     * Process.
     * 
     * @var array
     */
    protected $process;
    
    /**
     * Process.
     * 
     * @var array
     */
    protected $open = false;
    
    private $lastRead = -1;
    
    private $lastWrite = 0;
    
    /**
     * Creates a new Process instance.
     * 
     * @param  string  $command
     * @param  array  $env
     * @return void
     */
    public function __construct($command, array $env = [], $skipLines = 0)
    {
        $this->command = $command;
        $this->env = $env;
        $this->skipLines = $skipLines;
    }
    
    /**
     * Open the process.
     * 
     * @return void
     * 
     * @throws \RuntimeException when the process can not be started.
     */
    public function open()
    {
        if ($this->process) {
            return;
        }
        
        $this->process = proc_open($this->command, $this->descriptors, $this->pipes, getcwd(), $this->env);
        
        if (! is_resource($this->process)) {
            throw new RuntimeException('Could not start the process ' . $command . '.');
        }
        
        $this->open = true;
        
        stream_set_blocking($this->pipes[self::STDIN], false);
        stream_set_blocking($this->pipes[self::STDOUT], false);
        stream_set_blocking($this->pipes[self::STDERR], false);
        
        if ($this->skipLines && is_numeric($this->skipLines)) {
            for ($i = 0; $i < $this->skipLines; $i++) {
                var_dump('>>>', $this->readln());
            }
        }
    }
    
    /**
     * Check if the Process is open.
     * 
     * @return bool
     */
    public function isOpen()
    {
        return $this->open;
    }
    
    /**
     * Get the error.
     * 
     * @return string
     */
    public function getError()
    {
        return fgets($this->pipes[self::STDERR]);
    }
    
    /**
     * Read a line from the Process output.
     * 
     * @return bool
     */
    public function readln()
    {
        if (! $this->isOpen()) {
            return false;
        }
        
        $line = false;
        
        if ($this->lastWrite > $this->lastRead) {
            while (($line = fgets($this->pipes[self::STDOUT])) === false) {}
        }
        
        $this->onRead();
        
        return $line;
    }
    
    /**
     * Read multiple lines from the Process output at once.
     * 
     * @param  int  $count
     * @return array
     */
    public function readLines($count = 1)
    {
        if (! $this->isOpen()) {
            return false;
        }
        
        $lines = [];
        
        for ($i = 0; $i < $count; $i++) {
            $lines[] = $this->readln();
        }
        
        return $lines;
    }
    
    /**
     * Check if the next Process output character can be read.
     * 
     * @return bool
     */
    public function canRead()
    {
        return $this->isOpen() && ! feof($this->pipes[self::STDOUT]);
    }
    
    /**
     * Read a character from the Process output.
     * 
     * @return string|false
     */
    public function read()
    {
        if (! $this->isOpen()) {
            return false;
        }
        
        return fgetc($this->pipes[self::STDOUT]);
    }
    
    /**
     * Write a line to the Process input.
     * 
     * @param  string  $str
     * @return void|false
     */
    public function writeln($str)
    {
        if ($this->isOpen()) {
            return $this->write($str . "\n");
        }
    }
    
    /**
     * Write a astring to the Process input.
     * 
     * @param  string  $str
     * @return void|false
     */
    public function write($str)
    {
        if ($this->isOpen()) {
            $this->onWrite();
            
            return fwrite($this->pipes[self::STDIN], $str);
        }
        
        return false;
    }
    
    /**
     * Get the Process status.
     * 
     * @return array
     */
    public function getStatus()
    {
        return proc_get_status($this->process);
    }
    
    /**
     * Close the Process.
     * 
     * @return string|void
     */
    public function close()
    {
        if ($this->isOpen()) {
            $this->open = false;
            
            fclose($this->pipes[self::STDIN]);
            fclose($this->pipes[self::STDOUT]);
            fclose($this->pipes[self::STDERR]);
            
            return proc_close($this->process);
        }
    }
    
    /**
     * Close the Process.
     * 
     * @return void
     */
    public function __destruct()
    {
        $this->close();
    }
    
    /**
     * Close the Process and return the properties to serialize.
     * 
     * @return array
     */
    public function __sleep()
    {
        $this->close();
        
        return ['command', 'env', 'descriptors', 'open'];
    }
    
    /**
     * Unserialize the Process and open it again if it was running.
     * 
     * @return void
     */
    public function __wakeup()
    {
        if ($this->isOpen()) {
            $this->open();
        }
    }
    
    protected function onRead()
    {
        $this->lastRead = microtime(true);
    }
    
    protected function onWrite()
    {
        $this->lastWrite = microtime(true);
    }
}

$p = new Process('php -a', [], 2);
$p->open();

$p->writeln('var_dump($_ENV);');
//$p->writeln('throw new Exception("bye");');

var_dump($p->readln());
