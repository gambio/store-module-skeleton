<?php


class SkeletonConfiguration
{
    public function getTimerValue()
    {
        return 20;
    }
    
    public function getTimerStarted()
    {
        return time() - 20;
    }
    
}
