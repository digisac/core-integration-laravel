@extends('core-integration-laravel::layout')
@section('title', 'Dashboard')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Requisições
    </h1>
    <p class="mb-4">Listagem de requisições</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div>
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered yajra-datatable">
                                <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Endpoint</th>
                                    <th>Método</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="/vendor/digisac/core-integration-laravel/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/digisac/core-integration-laravel/js/dataTables.bootstrap4.min.js"></script>
    <style>
        .dataTables_filter {
            float: right;
        }
    </style>
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                lengthChange: false,
                ajax: "{{ route('request.data') }}",
                columns: [
                    {data: 'created_at', name: 'created_at'},
                    {data: 'endpoint', name: 'endpoint'},
                    {data: 'method', name: 'method'},
                    {data: 'type', name: 'type'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });

        });
    </script>

@endsection
