function clock() {


    const fulldate = new Date();
    var hours = fulldate.getHours();
    var mins = fulldate.getMinutes();
    var secs = fulldate.getSeconds();
    var date = fulldate.getDate();
    var month = fulldate.getMonth();
    var year = fulldate.getFullYear();
    

    if (hours < 10) {
        hours = "0" + hours;
    }

    if (mins < 10) {
        mins = "0" + mins;
    }


    if (secs < 10 ) {
        secs = "0" + secs;
    }

    document.getElementById('hour').innerHTML = hours;
    document.getElementById('minute').innerHTML = mins;
    document.getElementById('second').innerHTML = secs;
    document.getElementById('date').innerHTML = date;
    document.getElementById('month').innerHTML = month+1;
    document.getElementById('year').innerHTML = year;
}

setInterval(clock, 1000);
