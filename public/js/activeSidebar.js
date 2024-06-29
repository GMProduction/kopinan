var url = window.location.pathname.split('/');
var lok2 = url[2];
var lok1 = url[1];
var lok3 = url[3];

$(document).ready(function () {
    setActive();
})

function setActive() {
    if (lok1 === 'admin'){
        if (lok2 === undefined || lok2 === '') {
            $('#sidebar .dashboard').addClass('active');
        } else {
            $('#sidebar #' + lok2).addClass('active');
        }
        if (lok3) {
            console.log('#sub-' + lok2);
            $('#sub-' + lok2).collapse();
            $('#sub-' + lok2 + ' #' + lok3).addClass('active');
            $('#drop-' + lok2 + ' #' + lok3).addClass('active');

        }
    }else {

        if (lok1 === undefined || lok1 === '') {
            $('#sidebar .dashboard').addClass('active');
        } else {
            $('#sidebar #' + lok1).addClass('active');
        }
        // if (lok3) {
        //     $('#sub-' + lok2).collapse();
        //     $('#sub-' + lok2 + ' #' + lok3).addClass('active');
        //     $('#drop-' + lok2 + ' #' + lok3).addClass('active');
        //
        // }
    }
    // if (lok2 === 'info') {
    //     $('#colapse-profile').addClass('active');
    //     $('.collapsible-body').attr('style', 'display:block');
    //     $('#' + lok3).addClass('active');
    // } else if (lok2 === 'kost' || lok2 === 'kontrakan' || lok2 === 'persewaan' || lok2 === 'guest-house') {
    //     // $('#colapse_property').addClass('active');
    //     $('.collapsible-body').attr('style', 'display:block');
    //     // $('#'+lok3).addClass('active');
    // }
}
