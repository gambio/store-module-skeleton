<?php


class SkeletonConfiguration
{
    private $storeConfiguration;
    
    
    public function __construct($storeConfiguration)
    {
        $this->storeConfiguration = $storeConfiguration;
    }
    
    public function setTimerValue($value)
    {
        if ($this->storeConfiguration->get('SKELETON_TIMER') === null) {
            $this->storeConfiguration->create('SKELETON_TIMER', $value);
        } else {
            $this->storeConfiguration->set('SKELETON_TIMER', $value);
        }
    }
    
    public function getTimerValue()
    {
        return $this->storeConfiguration->get('SKELETON_TIMER');
    }
    
    public function getTimerStarted()
    {
        return $this->storeConfiguration->get('SKELETON_TIMER_STARTED');
    }
    
    public function resetTimer()
    {
        return $this->storeConfiguration->remove('SKELETON_TIMER_STARTED');
    }
    
    public function setTimerStarted($value)
    {
        if ($this->storeConfiguration->get('SKELETON_TIMER_STARTED') === null) {
            $this->storeConfiguration->create('SKELETON_TIMER_STARTED', $value);
        } else {
            $this->storeConfiguration->set('SKELETON_TIMER_STARTED', $value);
        }
    }
}
