@extends('base')

@section('content')
    <div class="row">
        <div class="col-md-3 d-flex flex-column">
            <div class="rounded bg-white p-3">
                <div class="w-100">
                    <label for="name" class="form-label fw-bold">Nama Pemesanan</label>
                    <input type="text" readonly class="form-control bg-white" id="name" name="name" required
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
                           value="{{\App\Helper\StringStatus::getStatusPesanan($data->status_pesanan)}}">
                </div>
                <div class="w-100">
                    <label for="name" class="form-label fw-bold">Status Pembayaran</label>
                    <input type="text" readonly class="form-control bg-white" id="name" name="name" required
                           value="{{\App\Helper\StringStatus::getStatusPembayaranAdmin($data->status_pembayaran)}}">
                </div>
            </div>
            <div class=" my-3" style="border-bottom: 1px solid #4a5568"></div>
            <div class="rounded bg-white p-3 ">
                <span>Data Pembayaran</span>
                <div class="w-full d-flex justify-content-center">
                    @if($data->image_payment)
                        <img src="{{$data->image_payment}}" class="my-3" width="400" height="400" style="object-fit: cover; width: auto; height: auto" onclick="showImage()">
                    @else
                        <span class="my-3">Belum ada Pembayaran</span>
                    @endif
                </div>
                @if($data->status_pesanan == 1 && $data->status_pembayaran != 1)
                    <div class="d-flex flex-md-row flex-column justify-content-between">
                        <Button class="btn btn-sm btn-primary2" onclick="updateStatus(1,'status_pembayaran')" {{$data->image_payment ? '' : 'disabled'}}>Terima
                            Pembayaran
                        </Button>
                        <Button class="btn btn-sm btn-danger mx-md-2 mt-md-0 mt-2" onclick="updateStatus(2,'status_pembayaran')"
                            {{$data->image_payment ? '' :'disabled'}}>Tolak Pembayaran
                        </Button>
                    </div>
                @endif
            </div>
        </div>
        <div class="p-3 rounded bg-white col-md-9 d-flex flex-column justify-content-between">
           <div class="table-responsive">
               <table id="table" class="display nowrap" style="width:100%">
                   <thead>
                   <tr>
                       <th>#</th>
                       <th>Nama menu</th>
                       <th>Catatan</th>
                       <th>Harga</th>
                       <th>Qty</th>
                       <th>Sub Total</th>
                   </tr>
                   </thead>
               </table>
           </div>
            <div class="d-flex flex-md-row flex-column justify-content-between ">
                <div class="d-flex order-md-0 order-2" style="align-items: center">
                    <div class="d-flex" style="align-items: center">
                        @if($data->status_pesanan == 0)
                            <Button class="btn btn-sm btn-primary2" onclick="updateStatus(1,'status_pesanan')">Terima Pesanan</Button>
                            <Button class="btn btn-sm btn-danger mx-2" onclick="updateStatus(3,'status_pesanan')">Tolak Pesanan</Button>
                        @endif
                        @if($data->status_pesanan == 1)
                            <Button class="btn btn-sm btn-primary" onclick="updateStatus(2,'status_pesanan')" {{$data->status_pembayaran == 1 && $data->status_pesanan == 1 ? '' : 'disabled'}} >Pesanan
                                Diambil
                            </Button>
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-end my-md-0 my-3">
                    <div class="p-2 border rounded fw-semibold ">
                        <span class="">Total</span>
                        <span>Rp. {{number_format($data->total_price)}}</span>
                        <span> | </span>
                        <span>Poin : {{$data->total_point}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalImg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Foto Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div>
                    <div class="modal-body">
                        <div class="w-full d-flex justify-content-center" style="height: 200px">

                            <img style="object-fit: contain" src="{{$data->image_payment}}">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-danger  btn-sm" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        var myModal = new bootstrap.Modal(document.getElementById("modalImg"), {});

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
                    data: 'price', name: 'price',
                    render:(e,x,d) => {
                        if (d.is_point){
                            return e
                        }else {
                            return 'Rp. ' + parseFloat(e).toLocaleString();
                        }
                    }
                },
                {
                    data: 'qty', name: 'qty'
                },
                {
                    data: 'sub_total', name: 'sub_total',
                    render:(e,x,d) => {
                        if (d.is_point){
                            return e
                        }else {
                            return 'Rp. ' + parseFloat(e).toLocaleString();
                        }
                    }
                },
            ];
            datatable('table', '{{route('transaction.detail.datatable',['id' => $data->id])}}', colums)
        }

        function showImage() {
            myModal.show();
        }

        function updateStatus(state, type) {
            const form = {
                '_token': '{{csrf_token()}}',
                id: '{{$data->id}}',
                status: state,
                type: type
            }
            let title = 'Pembayaran'
            let status = 'Menolak'
            if (type.includes('pesanan')) {
                title = 'Pesanan'
                if (state == 1) {
                    status = 'Menerima'
                } else if (state == 2) {
                    status = 'Mengambil'
                }
            } else {
                if (state == 1) {
                    status = 'Menerima'
                }
            }

            saveDataAjax(status + ' ' + title, form, '{{route('transaction.confirm')}}', null, 'modalImg')
            return false;
        }

        function aftersaveCategory() {

        }
    </script>
@endsection
