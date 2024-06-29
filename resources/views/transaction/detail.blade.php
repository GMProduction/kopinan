@extends('base')

@section('content')
    <div class="d-flex justify-content-end my-3">
        <button class="btn btn-primary" id="addData">Tambah</button>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="rounded bg-white p-3">
               <div class="w-100">
                   <label for="name" class="form-label fw-bold">Nama Pemesanan</label>
                   <input type="text" readonly  class="form-control bg-white" id="name" name="name" required
                          value="{{$data->user->name}}">
               </div>
                <div class="w-100">
                    <label for="name" class="form-label fw-bold">Alamat</label>
                    <textarea type="text" readonly class="form-control bg-white" id="name" name="name" required
                    >{{$data->user->address}}</textarea>
                </div>
                <div class="w-100">
                    <label for="name" class="form-label fw-bold">Nomor Telp</label>
                    <input type="text" readonly class="form-control bg-white" id="name" name="name" required
                           value="{{$data->user->phone}}">
                </div>
                <div class="w-100">
                    <label for="name" class="form-label fw-bold">Status Pesanan</label>
                    <input type="text" readonly class="form-control bg-white" id="name" name="name" required
                           value="">
                </div>
            </div>

        </div>
        <div class="p-3 rounded bg-white col-md-9 d-flex flex-column justify-content-between">
            <table id="table" class="display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama menu</th>
                    <th>Catatan</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Sub Totalr</th>
                </tr>
                </thead>
            </table>
            <div class="d-flex justify-content-between">
               <div class="d-flex" style="align-items: center">
                   <div class="d-flex" style="align-items: center">
                       <Button class="btn btn-sm btn-primary2">Terima Pesanan</Button>
                       <Button class="btn btn-sm btn-danger mx-2">Tolak Pesanan</Button>
                       <Button class="btn btn-sm btn-primary">Pesanan Diambil</Button>
                   </div>
               </div>
                <div class="p-2 border rounded fw-semibold">
                    <span class="">Total</span>
                    <span>Rp. {{number_format($data->total_price)}}</span>
                </div>
            </div>
        </div>
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
                    data: 'item_all.name', name: 'item_all.name',
                },
                {
                    data: 'note', name: 'note',
                },
                {
                    data: 'price', name: 'price'
                },
                {
                    data: 'qty', name: 'qty'
                },
                {
                    data: 'sub_total', name: 'sub_total'
                },
            ];
            datatable('table', '{{route('transaction.detail.datatable',['id' => $data->id])}}', colums)
        }

    </script>
@endsection
