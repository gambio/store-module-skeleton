var defaults = {}
    , face = document.getElementById('lazy')
    , remained = face.dataset.remained // seconds
    , timer_value = face.dataset.timer_value // seconds

var timerInterval = setInterval(tick, 1000);

function tick() {
    face.innerText = convertSecondsToVisualClock(remained--);
    if (remained < 0) {
        clearInterval(timerInterval);
    }
}

function convertSecondsToVisualClock(seconds) {
    var parts = [];
    parts[0] = '' + Math.floor(seconds / 3600);
    parts[1] = '' + Math.floor((seconds / 60) % 60);
    parts[2] = '' + Math.floor(seconds % 60);
    return parts.join(':');
}

document.getElementById('skeleton-timer-reset').onclick = function changeContent() {
    face.innerText = convertSecondsToVisualClock(timer_value);
    remained = timer_value;
}
