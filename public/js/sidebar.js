var url = window.location.pathname.split('/');
var lok2 = url[2];
var lok1 = url[1];
var lok3 = url[3];
$(document).ready(function () {
    // tgl_mulai();
    var clas = localStorage.getItem('sidebar');

    // if (clas === '') {
    //     $('#sidebar').addClass('active');
    //     if (lok2 === undefined || lok2 === '') {
    //         $('#sidebar #dashboard').addClass('active');
    //     } else {
    //         $('#sidebar #' + lok2).addClass('active');
    //     }
    // } else {
    //     $('#sidebar').removeClass('active');
    //
    // }
    // setActive();

    $('#tableData_wrapper .dataTables_filter').html('asd');

    $('.checktext').click(function () {
        if ($(this).prop("checked") == true) {
            $('#text' + $(this).attr('id')).removeAttr('disabled');
        } else if ($(this).prop("checked") == false) {
            $('#text' + $(this).attr('id')).attr('disabled', '');
            $('#text' + $(this).attr('id')).val('');

        }
    });

    $('.checktextSelect2').click(function () {
        if ($(this).prop("checked") == true) {
            $('#text' + $(this).attr('id')).removeAttr('disabled');
        } else if ($(this).prop("checked") == false) {
            $('#text' + $(this).attr('id')).attr('disabled', '');
            $('#text' + $(this).attr('id')).val('').trigger('change').select2();

        }
    });
});






(function ($) {

    "use strict";

    var fullHeight = function () {

        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function () {
            $('.js-fullheight').css('height', $(window).height());
        });

    };
    fullHeight();

    $('#sidebarCollapse').on('click', function (ev) {
        // var sidebar = $('#sidebar').toggleClass('active');
        var clas = $('#sidebar').attr('class');
        if (clas === '') {
            $('#sidebar').addClass('active');
            $('#sidebar li a label').addClass('d-none');
            // $('#image-sidebar').addClass('d-none');
            $('#user-sidebar').addClass('d-none');
            $('#sidebar li a').addClass('justify-content-center');
            $('#sidebar li a i').addClass('fs-2');
            $('#sidebar .list-group-item small').addClass('d-none');
            $('#sidebar li a span').addClass('d-none');
            $('#sidebar .list-group-item').addClass('d-none');
            $('#sidebar .ini-collapse a').removeClass('justify-content-between');
            $('#sidebar .ini-collapse').addClass('c-hide');
            $('#sidebar .d-collapse').addClass('position-absolute -mt-5 bg-white list-unstyled ').removeClass('sub-menu ');
            $('#sidebar .d-collapse li').addClass('bg-white')
            $('#sidebar .d-collapse li a').addClass('tx-primary px-3 ').removeClass('justify-content-center')
            $('#sidebar .ini-dropdown ').removeClass('d-none');
            $('#sidebar .sub-menu ').addClass('d-none');
            $('#sidebar #titleApps ').addClass('d-none');

            // $('#sidebar .ini-collapse ').removeAttr('data-toggle');
            // $('#sidebar .ini-collapse a').attr('data-toggle', 'dropdown');

        } else {
            $('#sidebar').removeClass('active');
            $('#sidebar li a label').removeClass('d-none');
            // $('#image-sidebar').removeClass('d-none');
            $('#user-sidebar').removeClass('d-none');
            $('#sidebar li a').removeClass('justify-content-center');
            $('#sidebar li a i').removeClass('fs-2');
            $('#sidebar .list-group-item small').removeClass('d-none');
            $('#sidebar .list-group-item').removeClass('d-none');
            $('#sidebar li a span').removeClass('d-none');
            $('#sidebar .ini-collapse a').addClass('justify-content-between');
            $('#sidebar .ini-collapse').removeClass('c-hide');
            $('#sidebar .d-collapse').removeClass('position-absolute -mt-5 bg-white list-unstyled ').addClass('sub-menu ');
            $('#sidebar .d-collapse li').removeClass('bg-white')
            $('#sidebar .d-collapse li a').removeClass('tx-primary px-3 ')
            $('#sidebar .ini-dropdown ').addClass('d-none');
            $('#sidebar .sub-menu ').removeClass('d-none');
            $('#sidebar #titleApps ').removeClass('d-none');

            // $('#sidebar .ini-collapse ').attr('data-toggle', 'collapse');
            // $('#sidebar .ini-collapse a').removeAttr('data-toggle').removeAttr('data-target').removeAttr('aria-expanded');

        }
        localStorage.setItem("sidebar", clas);

    });

})(jQuery);

$(document).ready(function () {
    var clas = localStorage.getItem("sidebar");
    if (clas === '') {
        $('#sidebar').addClass('active');
        $('#sidebar li a label').addClass('d-none');
        // $('#image-sidebar').addClass('d-none');
        $('#user-sidebar').addClass('d-none');
        $('#sidebar li a').addClass('justify-content-center');
        $('#sidebar li a i').addClass('fs-2');
        $('#sidebar .list-group-item small').addClass('d-none');
        $('#sidebar li a span').addClass('d-none');
        $('#sidebar .list-group-item').addClass('d-none');
        $('#sidebar .ini-collapse a').removeClass('justify-content-between');
        $('#sidebar .ini-collapse').addClass('c-hide');
        $('#sidebar .d-collapse').addClass('position-absolute -mt-5 bg-white list-unstyled ').removeClass('sub-menu');
        $('#sidebar .d-collapse li').addClass('bg-white')
        $('#sidebar .d-collapse li a').addClass('tx-primary px-3 ').removeClass('justify-content-center')
        $('#sidebar .ini-dropdown ').removeClass('d-none');
        $('#sidebar .sub-menu ').addClass('d-none')

        // $('#sidebar .ini-collapse ').removeAttr('data-toggle');
        // $('#sidebar .ini-collapse a').attr('data-toggle', 'dropdown');
    } else {
        $('#sidebar').removeClass('active');
        $('#sidebar li a label').removeClass('d-none');
        // $('#image-sidebar').removeClass('d-none');
        $('#user-sidebar').removeClass('d-none');
        $('#sidebar li a').removeClass('justify-content-center');
        $('#sidebar li a i').removeClass('fs-2');
        $('#sidebar .list-group-item small').removeClass('d-none');
        $('#sidebar .list-group-item').removeClass('d-none');
        $('#sidebar li a span').removeClass('d-none');
        $('#sidebar .ini-collapse a').addClass('justify-content-between');
        $('#sidebar .ini-collapse').removeClass('c-hide');
        $('#sidebar .d-collapse').removeClass('position-absolute -mt-5 bg-white list-unstyled ').addClass('sub-menu ');
        $('#sidebar .d-collapse li').removeClass('bg-white')
        $('#sidebar .d-collapse li a').removeClass('tx-primary px-3 ')
        $('#sidebar .ini-dropdown ').addClass('d-none');
        $('#sidebar .sub-menu ').removeClass('d-none');

        // $('#sidebar .ini-collapse ').attr('data-toggle', 'collapse');
        // $('#sidebar .ini-collapse a').removeAttr('data-toggle').removeAttr('data-target').removeAttr('aria-expanded');

    }
});

$(document).ajaxStop(function () {
    flexFont();
});

// $('.ini-collapse').on('click', function (ev) {
//     console.log(ev.currentTarget.id);
//     var id = ev.currentTarget.id;
//     var clas = $('#sidebar').attr('class');
//     if (clas === '') {
//         // $('#' + id + ' a').attr('data-target', "#drop-" + id);
//         // $('#drop-'+id+' .sub-menu').css({
//         // 	left: $('#content').offset().left,
//         // 	top: $('#'+id).offset().top,
//         //
//         // });
//     } else {
//
//     }
//
// });


// $('.data-hover').hover(function (ev) {
//     if(ev.type === 'mouseenter'){
//         var id = ev.target.childNodes[1].innerHTML;
//         $(this).attr('title', id);
//     }
//
// });


flexFont = function () {
    var divs = document.getElementsByClassName("flexFont");
    // var divs = $('.flexFont');
    for(var i = 0; i < divs.length; i++) {
        var relFontsizeLabel = divs[i].offsetWidth*0.08+'px';
        var relFontsizespan = divs[i].offsetWidth*0.06+'px';
        var relFontsizespan1 = divs[i].offsetWidth*0.05+'px';
        // divs[i].style.fontSize = relFontsize+'px';
        divs[i].childNodes[1].childNodes[1].style.fontSize = relFontsizespan1;
        divs[i].childNodes[1].childNodes[5].style.fontSize = relFontsizeLabel;
        divs[i].childNodes[1].childNodes[7].style.fontSize = relFontsizespan1;

        // console.log(divs[i].childNodes[1].childNodes);
        // console.log(divs[i]);
        // console.log(divs[i].childNodes[1].childNodes);

    }
};

window.onload = function(event) {
    flexFont();
};
window.onresize = function(event) {
    flexFont();
};
