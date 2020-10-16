@extends('core-integration-laravel::layout')
@section('title', 'Dashboard')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Requisições <strong>{{\Request::get('type') ? "'".\Request::get('type')."'" : ''}}</strong>
    </h1>
    <p class="mb-4">Listagem de requisições enviadas.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div>
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                    <?php if(count($sendRequests)){
                                        foreach($sendRequests as $SendRequest){ ?>
                                            <tr>
                                                <td>{{\Carbon\Carbon::parse($SendRequest->created_at)->format('d/m/Y')}}</td>
                                                <td><a href="javascript:void(0);">{{$SendRequest->endpoint }}</a></td>
                                                <td>{{$SendRequest->method}}</td>
                                                <td>{{$SendRequest->type}}</td>
                                                <td>{{$SendRequest->status}}</td>
                                                <td>
                                                    <a href="javascript:void(0)" data-id="{{$SendRequest->id}}" class="view-request btn btn-primary btn-sm" style="width:100%;">Visualizar</a>
                                                    <a href="javascript:void(0)" data-url="send-request" data-id="{{$SendRequest->id}}" class="delete btn btn-danger btn-sm" style="width:100%;">Excluir</a>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                </tbody>
                            </table>

                            {!! $sendRequests->appends(request()->except('page')) !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalRequestView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" style="max-width:100% !important;width:80% !important" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;">Requisição: <b id="type"></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="view-request">
                    <div class="row">
                        <div class="col-sm-8">
                            Endpoint: <b id="endpoint"></b>
                        </div>
                        <div class="col-sm-4">
                            Data/Hora: <b id="datetime" style="text-align:right"></b>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-sm-6">
                            <p style="text-align: center;">Requisição</p>
                            <code id="request"> </code>
                        </div>
                        <div class="col-sm-6">
                            <p style="text-align: center;">Resposta</p>
                            <code id="response"> </code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {

            $('body').on('click', '.view-request', function () {
                $.get('/send-request/' + $(this).attr('data-id') + '/view', {}, function (data) {
                    $('#type').html(data.type);
                    $('#datetime').html(data.datetime);
                    $('#endpoint').html(data.endpoint);
                    $('#request').html(data.request);
                    $('#response').html(data.response);
                    //Show Modal
                    $('#modalRequestView').modal();
                }, 'json');
            });

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                lengthChange: false,
                ajax: "{{ route('request.data') }}?{{http_build_query(\Request::all())}}",
                columns: [
                    {data: 'created_at', name: 'created_at'},
                    {data: 'endpoint', name: 'endpoint'},
                    {data: 'method', name: 'method'},
                    {data: 'type', name: 'type'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ],
                "order": [[0, "desc"]]
            });

        });
    </script>
@endsection
