<?php

namespace DigiSac\Base\Http\Controllers;

use App\Services\DigiSacAuthorizationService;
use DigiSac\Base\Models\SendRequest;
use DigiSac\Base\Repositories\SendRequestRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SendRequestController extends Controller
{

    public function index()
    {
        return view('core-integration-laravel::send_request.index');
    }

    public function data(Request $request)
    {
        $data = new SendRequest();
        if($request->get('type')){
            $data = $data->where('type',$request->get('type'));
        }
        $data = $data->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('endpoint',function ($row){
                $endpoint = '<b><a href="'.$row->endpoint.'" target="_blank">' . $row->endpoint . '</a></b>';
                return $endpoint;
            })
            ->addColumn('created_at', function ($row) {
                $date = \DateTime::createFromFormat('Y-m-d H:i:s', $row->created_at);
                return $date->format('d/m/Y H:i');
            })
            ->addColumn('action', function ($row) {
                $btn = '
                <a href="javascript:void(0)" data-id="' . $row->id . '" class="view-request btn btn-primary btn-sm">Visualizar</a>
                <a href="javascript:void(0)" data-url="send-request" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Excluir</a>';
                return $btn;
            })
            ->rawColumns(['endpoint','action', 'created_at'])
            ->make(true);
    }

    public function view(Request $request,$id){
        $SendRequest = SendRequest::find($id);

        $return = [
            'type'=>$SendRequest->type,
            'datetime'=>\DateTime::createFromFormat('Y-m-d H:i:s',$SendRequest->created_at)->format('d/m/Y H:i'),
            'endpoint'=>$SendRequest->endpoint,
            'request'=>$SendRequest->request,
            'response'=>$SendRequest->response
        ];

        return json_encode($return);

    }

    public function test()
    {
        $data = [
            "event" => "bot.command",
            "data" => [
                "id" => "fa5f00bc-2a8a-4d80-b714-7bc5abe52689",
                "contactId" => "35cfdd38-a876-4864-93ea-37c7baaa42be",
                "accountId" => "3a4cbb07-681c-4780-9069-b584a9ed7203",
                "command" => "set-mail",
                "message" => [
                    "id" => "ada87157-5dd3-4df0-a7bf-c4bf91448ba6",
                    "isFromMe" => false,
                    "sent" => true,
                    "type" => "chat",
                    "timestamp" => "2020-09-03T19=>36=>09.000Z",
                    "data" => [
                        "ack" => -1,
                        "isNew" => true,
                        "isFirst" => false
                    ],
                    "visible" => true,
                    "accountId" => "3a4cbb07-681c-4780-9069-b584a9ed7203",
                    "contactId" => "35cfdd38-a876-4864-93ea-37c7baaa42be",
                    "fromId" => "35cfdd38-a876-4864-93ea-37c7baaa42be",
                    "serviceId" => "06572610-029f-4ca6-8f1f-98dcf12cd874",
                    "toId" => null,
                    "userId" => null,
                    "ticketId" => "8f2a8d76-25ea-4cba-b6cb-a2c34db91eb9",
                    "ticketUserId" => null,
                    "ticketDepartmentId" => "d39cb36f-43fd-4853-adf6-aa1752e4287a",
                    "quotedMessageId" => null,
                    "origin" => null,
                    "createdAt" => "2020-09-03T19=>36=>09.198Z",
                    "updatedAt" => "2020-09-03T19=>36=>09.371Z",
                    "deletedAt" => null,
                    "text" => "32456000@imusics.com",
                    "obfuscated" => false,
                    "file" => null,
                    "files" => null,
                    "quotedMessage" => null,
                    "isFromBot" => false,
                ]
            ],
            "webhookId" => "cc9bcfe9-813b-42c4-9db0-a5c446239775",
            "timestamp" => "2020-09-03T19=>36=>09.570Z"];


        $dev = new DigiSacAuthorizationService();
        dd($dev->request($data));
    }

    public function destroy(Request $request, $id)
    {
        $SendRequest = SendRequest::find($id);
        $SendRequest->delete();

        return redirect()->to('/send-request')->with(['message' => ['type' => 'success', 'message' => 'Requisição excluída com sucesso.']]);
    }
}
