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
            return $this->storeConfiguration->create('SKELETON_TIMER', $value);
        }
    
        return $this->storeConfiguration->set('SKELETON_TIMER', $value);
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
        return $this->storeConfiguration->set('SKELETON_TIMER_STARTED', 0);
    }
    
    public function setTimerStarted($value)
    {
        $timerStarted = $this->getTimerStarted();
        
        if (isset($timerStarted) && $timerStarted > 0) {
            return false;
        }
        
        if ($timerStarted === null) {
            return $this->storeConfiguration->create('SKELETON_TIMER_STARTED', $value);
        }
    
        return $this->storeConfiguration->set('SKELETON_TIMER_STARTED', $value);
    }
}
