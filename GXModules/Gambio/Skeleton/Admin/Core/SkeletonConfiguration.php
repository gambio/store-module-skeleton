<?php

/**
 * Class SkeletonConfiguration
 */
class SkeletonConfiguration
{
    /**
     * @var
     */
    private $storeConfiguration;
    
    
    /**
     * SkeletonConfiguration constructor.
     *
     * @param $storeConfiguration
     */
    public function __construct($storeConfiguration)
    {
        $this->storeConfiguration = $storeConfiguration;
    }
    
    
    /**
     * @param $value
     *
     * @return mixed
     */
    public function setTimerValue($value)
    {
        if ($this->storeConfiguration->get('SKELETON_TIMER') === null) {
            return $this->storeConfiguration->create('SKELETON_TIMER', $value);
        }
    
        return $this->storeConfiguration->set('SKELETON_TIMER', $value);
    }
    
    
    /**
     * Returns timer value.
     *
     * @return mixed
     */
    public function getTimerValue()
    {
        return $this->storeConfiguration->get('SKELETON_TIMER');
    }
    
    
    /**
     * Get timer start time.
     *
     * @return mixed
     */
    public function getTimerStarted()
    {
        $timeStarted = $this->storeConfiguration->get('SKELETON_TIMER_STARTED');
        return $timeStarted ?: 0;
    }
    
    
    /**
     * Sets timer started to zero.
     *
     * @return mixed
     */
    public function resetTimer()
    {
        return $this->storeConfiguration->set('SKELETON_TIMER_STARTED', 0);
    }
    
    
    /**
     * Sets time when timer starts.
     *
     * @param $value
     *
     * @return bool
     */
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
