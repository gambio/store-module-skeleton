<?php

require_once __DIR__ . '/SkeletonConfiguration.php';

class SkeletonTimeManager
{
    /**
     * @var
     */
    private static $instance;
    
    /**
     * @var
     */
    private $configuration;
    
    /**
     * SkeletonTimeManager constructor.
     *
     * @param $timerConfiguration
     */
    private function __construct($timerConfiguration)
    {
        $this->configuration = $timerConfiguration;
    }
    
    
    /**
     * Converts string time to seconds.
     *
     * @param string $timerValue
     *
     * @return float|int
     */
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
    
    
    /**
     * Reset timer.
     */
    public function resetTimer()
    {
        return $this->configuration->resetTimer();
    }
    
    
    /**
     * Sets timer started.
     */
    public function setTimerStarted()
    {
        $timer = $this->getTimerInSeconds();
        $timerStarted = (int) $this->configuration->getTimerStarted();
        
        if (time() - $timerStarted < $timer) {
            return false;
        }
        
        return $this->configuration->setTimerStarted(time());
    }
    
    
    /**
     * Sets timer to database.
     *
     * @param $value
     */
    public function setTimer($value)
    {
        $this->configuration->setTimerValue($value);
    }
    
    
    /**
     * Gets timer data.
     *
     * @return mixed
     */
    public function getTimer()
    {
        return $this->configuration->getTimerValue() ?: 0;
    }
    
    
    /**
     * Returns remained time.
     *
     * @return int
     */
    public function getRemainedTime()
    {
        $now = time();
        $timerValueInSeconds = $this->getTimerInSeconds() ?: 0;
        $timerStartedTimestamp = $this->configuration->getTimerStarted() ?: 0;
        
        $secondsFromStart = $now - $timerStartedTimestamp;
        $timerLeftSeconds = $timerValueInSeconds - $secondsFromStart;
        
        return $timerLeftSeconds > 0 ? $timerLeftSeconds : 0 ;
    }
    
    
    /**
     * @return \SkeletonTimeManager
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            
            define('StoreKey_MigrationScript', true);
            
            require_once __DIR__ . '/../../../../Gambio/Store/Core/Facades/GambioStoreFileSystemFacade.php';
            require_once __DIR__ . '/../../../../Gambio/Store/Core/Facades/GambioStoreDatabaseFacade.php';
            require_once __DIR__ . '/../../../../Gambio/Store/Core/Facades/GambioStoreCompatibilityFacade.php';
            require_once __DIR__ . '/../../../../Gambio/Store/Core/Facades/GambioStoreConfigurationFacade.php';
            
            $fileSystem = new GambioStoreFileSystemFacade();
            $database = GambioStoreDatabaseFacade::connect($fileSystem);
            $compatability = new GambioStoreCompatibilityFacade($database);
            $configuration = new GambioStoreConfigurationFacade($database, $compatability);
            
            self::$instance = new SkeletonTimeManager(new SkeletonConfiguration($configuration));
        }
        
        return self::$instance;
    }
    
    
    /**
     * @return float|int
     */
    public function getTimerInSeconds()
    {
        $timer = $this->getTimer();
        return $this->getSecondsFromTimerValue($timer);
    }
    
    
    /**
     * @param $timerValue
     *
     * @return string
     */
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
    
    private function __clone() {}
    public function __wakeup() {}
}
