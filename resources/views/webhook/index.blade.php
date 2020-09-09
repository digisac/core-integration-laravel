@extends('core-integration-laravel::layout')
@section('title', 'Dashboard')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Webhook</strong>
    </h1>
    <p class="mb-4">Listagem de requisições recebidas (DigiSac).</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div>
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered yajra-datatable">
                                <thead>
                                <tr>
                                    <th>Data/Hora</th>
                                    <th>Payload</th>
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


    <script type="text/javascript">
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                lengthChange: false,
                ajax: "{{ route('webhook.data') }}?{{http_build_query(\Request::all())}}",
                columns: [
                    {data: 'created_at', name: 'created_at'},
                    {data: 'payload', name: 'payload'},
                ],
                "order": [[0, "desc"]]
            });

        });
    </script>
@endsection
