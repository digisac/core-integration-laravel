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

    public function destroy(Request $request, $id)
    {
        $SendRequest = SendRequest::find($id);
        $SendRequest->delete();

	return redirect()->to('/send-request')->with(['message' => ['type' => 'success', 'message' => 'Requisição excluída com sucesso.']]);
    }
}

