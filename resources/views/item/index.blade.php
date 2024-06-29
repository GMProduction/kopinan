@extends('base')

@section('content')
    <div class="d-flex justify-content-end my-3">
        <button class="btn btn-primary" id="addData">Tambah</button>
    </div>
    <div class="p-3 rounded bg-white">
        <table id="table" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Jenis Menu</th>
                <th>Nama Menu</th>
                <th>Gambar</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form" enctype="multipart/form-data">
                    @csrf
                    <input id="id" name="id" hidden>
                    <div class="modal-body">
                        <div class="w-100">
                            <label for="selectCategory" class="form-label fw-bold">Jenis Menu</label>
                            <div class="d-flex ">
                                <select id="selectCategory" name="category_id" required style="width: 100%; margin-right: 5px">
                                </select>
                                <button type="button" class="btn btn-sm btn-primary" id="addDataCategory">+</button>
                            </div>
                        </div>
                        <div class="w-100">
                            <label for="name" class="form-label fw-bold">Nama Menu</label>
                            <input type="text" class="form-control bg-white" id="name" name="name" required
                                   value="">
                        </div>
                        <div class="w-100">
                            <label for="price" class="form-label fw-bold">Harga</label>
                            <input type="number" class="form-control bg-white" id="price" name="price" required
                                   value="">
                        </div>
                        <div class="w-100">
                            <label for="image" class="form-label fw-bold">Gambar</label>
                            <input type="file" class="form-control bg-white" id="image" name="image"
                                   value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <button type="button" class="btn-danger  btn-sm" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Jenis Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCategory" onsubmit="return postDataCategory()">
                    @csrf
                    <div class="modal-body">
                        <div class="w-100">
                            <label for="periodYear" class="form-label fw-bold">Nama Jenis Menu</label>
                            <input type="text" class="form-control bg-white" id="name" name="name"
                                   value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-sm">Simpan</button>
                        <button type="button" class="btn-danger  btn-sm" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        var myModal = new bootstrap.Modal(document.getElementById("modal"), {});
        var myModalCategory = new bootstrap.Modal(document.getElementById("modalCategory"), {});

        $(document).on('click', '#addData, #editData', function () {
            // $('#modal').modal('show')
            $('#modal #id').val($(this).data('id'))
            $('#modal #selectCategory').val('').trigger('change')

            if ($(this).data('category')){
                $('#modal #selectCategory').val($(this).data('category')).trigger('change')
            }
            $('#modal #price').val($(this).data('price'))
            $('#modal #name').val($(this).data('name'))
            $('#modal #image').val('')
            myModal.show();

        })

        $(document).on('click', '#addDataCategory', function () {
            // $('#modal').modal('show')
            $('#modalCategory #name').val('')
            myModalCategory.show();

        })

        $(document).ready(function () {
            show_datatable();
            getSelect('selectCategory', '{{route('category.json')}}', 'name', null, null, $('#modal'))
            postData()
        })

        function show_datatable() {
            let colums = [
                {
                    data: 'id', name: 'id', className: "text-center",
                },
                {
                    data: 'category.name', name: 'category.name'
                },
                {
                    data: 'name', name: 'name'
                },
                {
                    data: 'image', name: 'image',
                    render:(e) => {
                        return "<div>" +
                            "<img alt='' src='"+e+"' />" +
                            "</div>"
                    }
                },
                {
                    data: 'price', name: 'price'
                },
                {
                    className: "text-center",
                    data: 'id',
                    orderable: false, searchable: false,
                    render: function (x,y,row) {
                        return '<div class="">' +
                            '<button class="btn btn-sm btn-primary me-2" id="editData" data-id="'+row.id+'" data-category="'+row.category_id+'" data-name="'+row.name+'" data-image="'+row.image+'" data-price="'+row.price+'">Edit</button>' +
                            '<button class="btn btn-sm btn-danger" data-id="'+row.id+'" data-name="'+row.name+'" id="deleteItem">Delete</button>' +
                            '</div>'
                    }
                },
            ];
            datatable('table', '{{route('item.datatable')}}', colums)
        }

        function postDataCategory() {
            saveDataObjectFormData('Simpan Data', 'formCategory', '{{route('category')}}', aftersaveCategory)
            return false;
        }

        function aftersaveCategory() {
            myModalCategory.hide();
            getSelect('selectCategory', '{{route('category.json')}}', 'name', null, null, $('#modal'))
        }

        function postData() {
            let form = $('#form');
            form.submit(async function (e) {
                e.preventDefault(e);
                let formData = new FormData(this);
                let data = {
                    'form_data': formData,
                    // 'image': {
                    //     'icon': 'icon',
                    // }
                };
                saveDataAjaxWImage('Simpan Data', 'form', data, '{{route('item')}}', aftersave);
                return false;
            })
        }

        function aftersave() {
            myModal.hide();
            $('#table').DataTable().ajax.url('{{route('item.datatable')}}').load()
        }

        $(document).on('click', '#deleteItem', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let data = {
                _token: '{{ csrf_token() }}',
                id
            };
            postdeleteData(name, '{{route('item.delete')}}', data, aftersave);
            return false
        })
    </script>
@endsection
