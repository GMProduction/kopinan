@extends('base')

@section('content')
    <div class="d-flex justify-content-end my-3">
        <button class="btn btn-primary" id="addData">Tambah</button>
    </div>
    <div class="p-3 rounded bg-white">
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
                <th>Aksi</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('morejs')
    <script>
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
                    render:(e) => {
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
                    render:(e) => {
                        return 'Rp. '+parseFloat(e).toLocaleString();
               }
                },
                {
                    className: "text-center",
                    data: 'id',
                    orderable: false, searchable: false,
                    render: function (x,y,row) {
                        return '<div class="">' +
                            '<a class="btn btn-sm btn-primary2 me-2" id="editData" data-id="'+row.id+'" href="/transaction/'+row.transaction_number+'" >Detail</a>' +
                            '</div>'
                    }
                },
            ];
            datatable('table', '{{route('transaction.datatable')}}', colums)
        }


    </script>
@endsection
