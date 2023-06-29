@extends('core-integration-laravel::layout')
@section('title', 'Dashboard')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Empresas
        <a href="/company/create" class="btn btn-primary float-right"><i class="fa fa-building"></i> Nova Empresa</a>
    </h1>
    <p class="mb-4">Listagem de empresas.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div>
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered ">
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
                                <?php
                                    if(count($companies)){
                                        foreach($companies as $Company){ ?>
                                <tr>
                                    <td>{{$Company->name}}</td>
                                    <td>{{$Company->url}}</td>
                                    <td>{{$Company->token}}</td>
                                    <td>{{$Company->company_id}}</td>
                                    <td>
                                        <a href="{{route('company.edit', $Company->id) }}" class="edit btn btn-primary btn-sm">Editar</a>
                                        <a href="javascript:void(0)" data-url="company" data-id="{{$Company->id}}" class="delete btn btn-danger btn-sm">Excluir</a>
                                    </td>
                                </tr>
                                <?php }
                                    } ?>
                                </tbody>
                            </table>

                            {!! $companies->links() !!}
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
