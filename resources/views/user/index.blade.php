@extends('base')

@section('content')
    <div class="p-3 rounded bg-white">
        <table id="table" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Phone</th>
                    <th>Point</th>
                    <th>Email</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('morejs')
    <script>
        $(document).ready(function() {
            show_datatable();
        })

        function show_datatable() {
            let colums = [{
                    data: 'id',
                    name: 'id',
                    className: "text-center",
                },
                {
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'point',
                    name: 'point'
                },
                {
                    data: 'email',
                    name: 'email'
                },
            ];
            datatable('table', '{{ route('user.datatable') }}', colums)
        }
    </script>
@endsection
