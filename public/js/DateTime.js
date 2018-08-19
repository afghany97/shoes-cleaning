$(document).ready(function () {

    display_ct();
});

function display_c(){
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
    var strcount
    var x = new Date()
    time = x.toTimeString().split(' ')[0];
    document.getElementById('ct').innerHTML = x.getDate() + "-" + (x.getMonth() + 1) + "-" + x.getFullYear() + "   " + time;
    tt=display_c();
}