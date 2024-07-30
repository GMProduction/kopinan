@extends('base')

@section('content')

    <div class="p-3 rounded bg-white">
        <div class="w-50 mb-3">
            <label for="name" class="form-label fw-bold" >Scan QRCode</label>
            <input type="text"  class="form-control bg-white" id="qrcode"  placeholder="Scan disini ..."
                   value="">
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
                <th>Total Poin</th>
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
                {
                    data: 'total_point', name: 'total_point',
                },
                {
                    className: "text-center",
                    data: 'id',
                    orderable: false, searchable: false,
                    render: function (x, y, row) {
                        return '<div class="">' +
                            '<a class="btn btn-sm btn-primary2 me-2" id="editData" data-id="' + row.id + '" href="/transaction/' + row.transaction_number + '" >Detail</a>' +
                            '</div>'
                    }
                },
            ];
            datatable('table', '{{route('transaction.datatable')}}', colums)
        }


        var input = document.getElementById("qrcode");

        // Execute a function when the user presses a key on the keyboard
        input.addEventListener("keypress",async function(event) {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") {
                // Cancel the default action, if needed
                event.preventDefault();
                const value = input.value
                input.value = ''
                console.log('var', )
                // Trigger the button element with a click
               await $.get('/transaction/'+value+'/check')
                    .then(a => {
                       if (a?.payload){
                           window.location ='/transaction/'+value
                       }else {
                           swal("Data transaksi tidak ditemukan", {
                               icon: "info",
                               timer: 1000
                           })
                       }
                    })
                    .catch((e) => {
                        console.log('sdad',e)
                    })
                // document.getElementById("myBtn").click();
            }
        });

    </script>
@endsection
