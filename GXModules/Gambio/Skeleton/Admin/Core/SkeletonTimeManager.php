<?php

class SkeletonTimeManager
{
    public function getCountdownTimer()
    {
        $secondsSinceStart = $this->getTimeDiffFromNow(); // seconds
        $timerInSeconds = $this->getTimerConfigurationSeconds(); // seconds
        $diff = $timerInSeconds - $secondsSinceStart;
        
        return $this->convertFromSecondsToTime($diff > 0 ? $diff : 0);
    }

    private function isRunning()
    {

    }
    
    private function getStartDate()
    {
        return time() - 3590; // timestamp when we started the counter. returns 0 if not set or reseted.
    }

    
    private function getTimeDiffFromNow()
    {
        return time() - $this->getStartDate();
    }
    
    private function convertFromSecondsToTime($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor($seconds / 60 % 60);
        $seconds = floor($seconds % 60);

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
    
    private function getSecondsFromTimerValue($timerValue = '00:00:00')
    {
        $timeArray = explode( ':', $timerValue);
        $timeArray = array_reverse( $timeArray);

        $seconds = 0;
        foreach ($timeArray as $key => $timeValue) {
            $seconds += $timeValue * (60 ** $key);
        }
        
        return $seconds;
    }
    
    private function getTimerConfigurationSeconds()
    {
        return $this->getSecondsFromTimerValue(
            $this->getTimerConfigurationValue()
        );
    }
    
    // Fetches and returns user's value from db.
    private function getTimerConfigurationValue()
    {
        return '01:00:00';
    }
}
