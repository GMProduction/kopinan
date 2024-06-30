@extends('base')

@section('content')
    <div class="p-3 rounded bg-white">
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Tanggal Laporan</label>
            <form class="row" id="form" onsubmit="return changeDate()">
                <div class="col-md-4 ">
                    <input type="text" id="start_date" required placeholder="Tanggal awal"  class="form-control bg-white datepicker mx-0"
                           value="">
                </div>
                <div class="col-md-4 my-md-0 my-2">
                    <input type="text" id="end_date" required placeholder="Tanggal akhir"  class="form-control bg-white datepicker"
                           value="">
                </div>
                <div class="col-md-4 d-flex">
                   <button class="btn btn-sm btn-primary2 me-2" type="submit">Cari</button>
                   <a class="btn btn-sm btn-primary" type="button" onclick="reset()">Reset</a>
                </div>
            </form>
        </div>
        <table id="table" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Nomor Transaksi</th>
                <th>Nama Customer</th>
                <th>Waktu</th>
                <th>Status Pesanan</th>
                <th>Status Pembayaran</th>
                <th>No. Telp Customer</th>
                <th>Total</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('morejs')
    <script>
        const urlDatatable = '{{route('report.datatable')}}';
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });
        $(document).ready(function () {
            show_datatable();
        })

        function show_datatable() {
            let colums = [
                {
                    className: "text-center",
                    orderable: false,
                    defaultContent: "",
                    searchable: false
                },
                {
                    data: 'transaction_number', name: 'transaction_number',
                },
                {
                    data: 'user.name', name: 'user.name',
                },
                {
                    data: 'created_at', name: 'created_at',
                    render: (e) => {
                        return moment(e).format('LLL')
                    }
                },
                {
                    data: 'status_pesanan', name: 'status_pesanan'
                },
                {
                    data: 'status_pembayaran', name: 'status_pembayaran'
                },
                {
                    data: 'user.phone', name: 'user.phone'
                },
                {
                    data: 'total_price', name: 'total_price',
                    render: (e) => {
                        return 'Rp. ' + parseFloat(e).toLocaleString();
                    }
                },
            ];
            datatable('table', urlDatatable, colums)
        }

        function changeDate() {
            const start = $('#start_date').val()
            const end = $('#end_date').val()
            const url = urlDatatable+'?start_date='+start+'&end_date='+end
            $('#table').DataTable().ajax.url(url).load()
            return false
        }

        function reset() {
            $('#start_date').val('')
            $('#end_date').val('')
            console.log('urlDatatable',urlDatatable)
            $('#table').DataTable().ajax.url(urlDatatable).load()
        }


    </script>
@endsection
