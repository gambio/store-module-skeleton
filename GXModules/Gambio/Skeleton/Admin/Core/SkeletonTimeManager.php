<?php

require_once __DIR__ . '/SkeletonConfiguration.php';

class SkeletonTimeManager
{
    private static $instance;
    private $configuration;
    
    private function __clone() {}
    public function __wakeup() {}
    private function __construct($timerConfiguration)
    {
        $this->configuration = $timerConfiguration;
    }

    public function getSecondsFromTimerValue($timerValue = '00:00:00')
    {
        $timeArray = explode( ':', $timerValue);
        $timeArray = array_reverse($timeArray);

        $seconds = 0;
        foreach ($timeArray as $key => $timeValue) {
            $seconds += $timeValue * (60 ** $key);
        }

        return $seconds;
    }
    
    public function resetTimer()
    {
        $this->configuration->resetTimer();
    }
    
    public function setTimerStarted()
    {
        $this->configuration->setTimerStarted(time());
    }

    public function setTimer($value)
    {
        $this->configuration->setTimerValue($value);
    }

    public function getTimer()
    {
        return $this->configuration->getTimerValue();
    }
    
    public function getRemainedTime()
    {
        $now = time();
        $timerValueInSeconds = $this->getTimerInSeconds();
        $timerStartedTimestamp = $this->configuration->getTimerStarted();
        
        $secondsFromStart = $now - $timerStartedTimestamp;
        $timerLeftSeconds = $timerValueInSeconds - $secondsFromStart;
        
        return $timerLeftSeconds > 0 ? $timerLeftSeconds : 0 ;
    }
    
    public static function getInstance()
    {
        if (self::$instance === null) {

            define('StoreKey_MigrationScript', true);

            require_once __DIR__ . '/../../../Store/Core/Facades/GambioStoreFileSystemFacade.php';
            require_once __DIR__ . '/../../../Store/Core/Facades/GambioStoreDatabaseFacade.php';
            require_once __DIR__ . '/../../../Store/Core/Facades/GambioStoreCompatibilityFacade.php';
            require_once __DIR__ . '/../../../Store/Core/Facades/GambioStoreConfigurationFacade.php';

            
            $fileSystem = new GambioStoreFileSystemFacade();
            $database = GambioStoreDatabaseFacade::connect($fileSystem);
            $compatability = new GambioStoreCompatibilityFacade($database);
            $configuration = new GambioStoreConfigurationFacade($database, $compatability);

            self::$instance = new SkeletonTimeManager(new SkeletonConfiguration($configuration));
        }
        
        return self::$instance;
    }
    
    public function getTimerInSeconds()
    {
        $timer = $this->getTimer();
        return $this->getSecondsFromTimerValue($timer);
    }
    
    public function sanitize($timerValue)
    {
        $timeArray = explode( ':', $timerValue);
        $timeArray = array_replace(array_fill(0, 3, '00'), $timeArray);
        
        array_walk($timeArray, function($item, $key) {
            $item  = (int) $item;
            
            if ($key !== 0 && $item > 59) {
                $item = 59;
            }
            if ($key === 0 && $item > 23) {
                $item = 23;
            }
            
            return $item;
        });
        
        return implode( ':', $timeArray);
    }
}
