<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kopinan</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/genosstyle.1.0.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" type="text/css">
    {{-- <link rel="stylesheet"
        href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> --}}

    {{-- ICON --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/alertify.css') }}" type="text/css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <script src="{{ asset('js/jquery1.7.1.min.js') }}"></script>
    <script src="{{ asset('js/activeSidebar.js') }}"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
          integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    @yield('morecss')
</head>
<body>

{{--<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top bg-white" style="height: 100px">--}}
{{--    <a id="sidebarCollapse" class="btn">--}}
{{--        <i class="material-icons">menu</i>--}}
{{--    </a>--}}
{{--    <a class="navbar-brand" href="#">header Sidebar</a>--}}
{{--    <a class=""><span class="badge badge-primary">  asd</span></a>--}}

{{--</nav>--}}
<div class="wrapper d-flex align-items-stretch " style="height: calc(100vh)">
    <div class="d-flex flex-column" style="max-height: 100vh; ">
        <div class="image-sidebar ">
            <div class="d-flex  flex-column  " id="image-sidebar" style="justify-content: center; align-items: center; height: 70px">
                <div class="d-flex w-full mb-3" style="">
                    {{--                    <img src="{{ asset('assets/images/logo.svg') }}"/>--}}
                </div>
            </div>
        </div>

        <nav id="sidebar" class="" style="flex-grow: 1">
            <div class="overflow-auto" style="max-height: calc(100vh - 70px); ">
                <div id="sideNav" class="overflow-auto text-black" onscroll="scrollFungsi()" style="height: 100%">
                    <div id="titleApps" class="d-flex justify-content-center align-content-center flex-column">
                        <span class="text-center" style="font-size: 26px">Aplikasi</span>
                        <span class="text-center" style="font-size: 26px">Kopinan</span>
                    </div>
                    <ul class="list-unstyled components mb-5 ">
                        <li id="user" class="data-hover user" title="Data User">
                            <a href="{{route('user')}}">
                                <i class="material-icons menu-icon ">person</i>
                                <label class="m-0">Data User</label>
                            </a>
                        </li>
                        <li id="item" class="data-hover item" title="Item">
                            <a href="{{route('item')}}">
                                <i class="material-icons menu-icon ">menu_book</i>
                                <label class="m-0">Item</label>
                            </a>
                        </li>
                        <li id="transaction" class="data-hover dashboard" title="transaction">
                            <a href="{{route('transaction')}}">
                                <i class="material-icons menu-icon ">point_of_sale</i>
                                <label class="m-0">Transaksi</label>
                            </a>
                        </li>
                        <li id="dashboard" class="data-hover dashboard" title="Dashboard">
                            <a href="">
                                <i class="material-icons menu-icon ">receipt_long</i>
                                <label class="m-0">Laporan</label>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>

    </div>

    <div id="content" class="relative " style=" ">
        <div class="w-full  navbar-custom justify-content-between pe-3" style="height: 70px;background-color: #F4F7FE">
            <div class="w-full  navbar-custom gap-2" style="height: 70px">
                <a role="button" id="sidebarCollapse" class="m-0 d-flex text-primary" style="color: white; justify-content: center; align-items: center; text-decoration: none">
                    <i class="material-icons">menu</i>
                </a>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span id="akunName" class="text-white fw-semibold"></span>
                <div class="btn-group">
                    <a class="dropdown-toggle akun p-1" data-bs-toggle="dropdown" aria-expanded="false">

                        <i class="material-icons">person</i>
                    </a>
                    {{--                    <button type="button" class="btn btn-danger ">--}}
                    {{--                        Action--}}
                    {{--                    </button>--}}
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profile">Pengaturan Akun</a></li>
                        <li><a class="dropdown-item" href="/logout">Keluar</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="p-md-4 p-2 overflow-auto   " style="height: calc(100vh - 70px);background-color: #F4F7FE">
            <h3 class="m-0" id="titleDashboard"></h3>
            <div class="" style="">
                @yield('content')
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/base.js') }}"></script>
<script src="{{ asset('js/swal.js') }}"></script>
<script src="{{ asset('js/sidebar.js') }}"></script>
<script src="{{ asset('js/currency.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/momenttz.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/datepicker.id.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dialog.js') }}"></script>

<script>
    function scrollFungsi() {
        let sc = document.querySelector('#sideNav');
        var scroll = sc.scrollTop;
        localStorage.setItem("scroll", scroll);
    }
</script>
@yield('morejs')
<script>

    $(document).ready(function () {
        setTitleDashboard();
        if (lok2) {
            $('.sub-menu#sub-' + lok1).collapse();
            $('#sub-' + lok1 + ' #' + lok2).addClass('active');
            $('#drop-' + lok1 + ' #' + lok2).addClass('active');

        }
        moment.locale('id');

    })

    $(document).on('click', '.c-hide', function (ev) {
        console.log('#sub-' + ev.currentTarget.id)
        $('#sub-' + ev.currentTarget.id);

    })

    function setTitleDashboard() {
        let title = '';
        if (lok1 === undefined || lok1 === '') {
            // title = 'Tenaga Kesehatan';
            {{--if ('{{auth()->user()->role}}' === 'dinkes') {--}}
            {{--    title = 'Data Puskesmas';--}}
            {{--}--}}
        } else {
            let split = lok1.split('-').join(' ');
            if (split == 'laporan triwulan') {
                split = 'Monev Puskesmas';
            }

            if (split == 'rekap triwulan') {
                split = 'rekap triwulan dinkes';
            }

            if (split == 'pagu anggaran') {
                split = 'realisasi anggaran';
            }

            if (split == 'laporan capaian kinerja spm puskesmas') {
                split = 'kinerja capaian SPM bulanan';
            }
            title = capitalizeFirstLetter(split);

            if (url.includes('edit')) {
                title = title + ' - Update';
            } else if (url.includes('patch')) {
                title = title + ' - Edit Data';
            } else {
                if (lok2) {
                    let split2 = lok2.split('-').join(' ');
                    if (lok3 && lok3 == 'detail') {
                        split2 = lok3.split('-').join(' ');
                    }
                    if (split2 == 'laporan capaian standart pelayanan' || split2 == 'rekap capaian standart pelayanan') {
                        split2 = 'capaian kinerja SPM'
                    }
                    if (split2 == 'laporan pagu anggaran' || split2 == 'rekap pagu anggaran') {
                        split2 = 'realisasi anggaran'
                    }

                    title = title + ' - ' + capitalizeFirstLetter(split2);
                    if (lok1 === 'format-mutu-dan-sdm' || lok1 === 'laporan-triwulan' || lok1 === 'manajemen-user' || lok1 === 'rekap-triwulan') {
                        if (lok3) {
                            title = '<a class="me-1" role="button" onclick="window.history.back()"><i class="material-icons align-middle">arrow_back</i></a>' + title
                        }
                    } else {
                        title = '<a class="me-1" role="button" onclick="window.history.back()"><i class="material-icons align-middle">arrow_back</i></a>' + title
                    }
                }

            }
        }

        $('#titleDashboard').html(title)
    }

    function capitalizeFirstLetter(string) {
        const words = string.split(" ");

        for (let i = 0; i < words.length; i++) {
            words[i] = words[i][0].toUpperCase() + words[i].substr(1);
        }
        console.log('www', typeof words)
        return words.join(" ")
    }

    jQuery.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": oSettings._iDisplayLength === -1 ?
                0 : Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": oSettings._iDisplayLength === -1 ?
                0 : Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

</script>

</body>
</html>
