var defaults = {}
  , one_second = 1000
  , one_minute = one_second * 60
  , one_hour = one_minute * 60
  , face = document.getElementById('lazy')
  , currentTimer = face.innerHTML;

var timerInterval = setInterval(tick, 1000);

function tick() {

  var timestamp = calculateTimestamp(currentTimer);
  
  if (timestamp < 1) {
      clearInterval(timerInterval);
      return;
  }
  
  timestamp -= one_second;
  
  currentTimer = convertTimestampToVisualClock(timestamp);

  face.innerText = currentTimer;
  
}

function calculateTimestamp(timer) {
  var parts = timer.split(':');
  return parts[0] * one_hour + parts[1] * one_minute + parts[2] * one_second;
}

function convertTimestampToVisualClock(timestamp) {
  var parts = [];
  parts[0] = '' + Math.floor( timestamp / one_hour );
  parts[1] = '' + Math.floor( (timestamp % one_hour) / one_minute );
  parts[2] = '' + Math.floor( ( (timestamp % one_hour) % one_minute ) / one_second );
  return parts.join(':');
}
