document.addEventListener("DOMContentLoaded", function() {
    var defaults = {}
        , face = document.getElementById('lazy')
        , remained = face.dataset.remained // seconds
        , timer_value = face.dataset.timer_value // seconds
        , timerInterval;
    
    if (remained > 0) {
        face.innerText = convertSecondsToVisualClock(remained);
        startTimer();
    } else {
        face.innerText = convertSecondsToVisualClock(timer_value);
        stopTimer();
        remained = timer_value;
    }
    
    function tick() {
        face.innerText = convertSecondsToVisualClock(--remained);
        if (remained < 1) {
            stopTimer();
        }
    }
    
    function convertSecondsToVisualClock(seconds) {
        var parts = [];
        parts[0] = ('0' + Math.floor(seconds / 3600)).slice(-2);
        parts[1] = ('0' + Math.floor((seconds / 60) % 60)).slice(-2);
        parts[2] = ('0' + Math.floor(seconds % 60)).slice(-2);
        return parts.join(':');
    }
    
    function stopTimer() {
        clearInterval(timerInterval);
        timerInterval = null;
        
        var hands = document.querySelectorAll('.hand span');
        for (var i = 0; i < hands.length; i++) {
            hands[i].style['animation-name'] = 'unset';
        }
    }
    
    function startTimer() {
        if (!timerInterval) {
            timerInterval = setInterval(tick, 1000);
            
            var hands = document.querySelectorAll('.hand span');
            for (var i = 0; i < hands.length; i++) {
                if (i % 2 === 0) {
                    hands[i].style['animation-name'] = 'spin1';
                } else {
                    hands[i].style['animation-name'] = 'spin2';
                }
            }
        }
    }
    
    document.getElementById('skeleton-timer-reset').onclick = function changeContent() {
        fetch('admin.php?do=SkeletonModuleAjax/ResetTimer')
            .then(() => stopTimer())
            .then(() => face.innerText = convertSecondsToVisualClock(timer_value))
            .then(() => remained = timer_value);
    }
    
    document.getElementById('skeleton-timer-start').onclick = function changeContent() {
        fetch('admin.php?do=SkeletonModuleAjax/StartTimer')
            .then(() => startTimer());
    }
});
