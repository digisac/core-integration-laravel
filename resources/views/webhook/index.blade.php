@extends('core-integration-laravel::layout')
@section('title', 'Dashboard')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Webhook</h1>
    <p class="mb-4">Listagem de requisições recebidas (DigiSac).</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead>
                            <tr>
                                <th>Data/Hora</th>
                                <th>Payload</th>
                                <th width="15%">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(count($webhooks)){
                            foreach($webhooks as $Webhook){ ?>
                            <tr>
                                <td>{{\Carbon\Carbon::parse($Webhook->created_at)->format('d/m/Y')}}</td>
                                <td><code>{{$Webhook->payload}}</code></td>
                                <td  style="text-align: center;"><a href="javascript:void(0);" data-id="{{$Webhook->id }}"
                                       class="view-request btn btn-primary btn-sm">Visualizar</a></td>
                            </tr>
                            <?php } } ?>
                            </tbody>
                        </table>

                        {!! $webhooks->links() !!}
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
                    <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;">Histórico de
                        Requisições</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="webhook-request">

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('body').on('click', '.view-request', function () {
                $.get('/webhook/' + $(this).attr('data-id') + '/history', {}, function (data) {
                    $('#webhook-request').html(data);
                    //Show Modal
                    $('#modalRequestView').modal();
                });
            });
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                lengthChange: false,
                ajax: "{{ route('webhook.data') }}?{{http_build_query(\Request::all())}}",
                columns: [
                    {data: 'created_at', name: 'created_at'},
                    {data: 'payload', name: 'payload'},
                    {data: 'action', name: 'action'},
                ],
                "order": [[0, "desc"]]
            });


        });
    </script>
@endsection


