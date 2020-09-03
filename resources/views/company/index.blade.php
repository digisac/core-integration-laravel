@extends('core-integration-laravel::layout')
@section('title', 'Dashboard')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Empresas
        <a href="/company/create" class="btn btn-primary float-right"><i class="fa fa-building"></i> Nova Empresa</a>
    </h1>
    <p class="mb-4">Listagem de empresas</a>.</p>

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
                                    <th>Nome</th>
                                    <th>URL</th>
                                    <th>Token</th>
                                    <th>CompanyID</th>
                                    <th>Açoes</th>
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
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap4.min.js"></script>
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
                ajax: "{{ route('company.data') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'url', name: 'url'},
                    {data: 'token', name: 'token'},
                    {data: 'company_id', name: 'company_id'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                    },
                ]
            });

        });
    </script>

@endsection
