<?php namespace CupOfTea\PHPSandbox\State;

class NullState implements StateInterface
{
    /**
     * {@inheritdoc}
     */
    public function getEnv()
    {
        return [];
    }
    
    /**
     * {@inheritdoc}
     */
    public function setEnv($name, $value)
    {
        //
    }
    
    /**
     * {@inheritdoc}
     */
    public function getConstant($name)
    {
        return [];
    }
    
    /**
     * {@inheritdoc}
     */
    public function setConstant($name, $value)
    {
        //
    }
    
    /**
     * {@inheritdoc}
     */
    public function getVariable()
    {
        return [];
    }
    
    /**
     * {@inheritdoc}
     */
    public function setVariable($name, $value)
    {
        //
    }
}
