<?php

require_once __DIR__ . '/SkeletonConfiguration.php';

class SkeletonTimeManager
{
    private static $instance;
    private $configuration;
    
    private function __clone() {}
    private function __construct($timerConfiguration)
    {
        $this->configuration = $timerConfiguration;
    }

    private function getSecondsFromTimerValue($timerValue = '00:00:00')
    {
        $timeArray = explode( ':', $timerValue);
        $timeArray = array_reverse($timeArray);

        $seconds = 0;
        foreach ($timeArray as $key => $timeValue) {
            $seconds += $timeValue * (60 ** $key);
        }

        return $seconds;
    }


    public function getTimerValue()
    {
        return $this->configuration->getTimerValue();
    }
    
    public function getRemainedTime()
    {
        $now = time();
        $timerValueInSeconds = $this->getTimerValue();
        $timerStartedTimestamp = $this->configuration->getTimerStarted();
        
        $secondsFromStart = $now - $timerStartedTimestamp;
        $timerLeftSeconds = $timerValueInSeconds - $secondsFromStart;
        
        return $timerLeftSeconds > 0 ? $timerLeftSeconds : 0 ;
    }
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new SkeletonTimeManager(new SkeletonConfiguration);
        }
        
        return self::$instance;
    }
}
