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

    public function index(Request $request)
    {
        $sendRequests = SendRequest::where('type', $request->get('type'))->orderBy('created_at', 'DESC')->paginate(20);

        return view('core-integration-laravel::send_request.index')->with([
            'sendRequests' => $sendRequests
        ]);
    }

    public function view(Request $request, $id)
    {
        $SendRequest = SendRequest::find($id);

        $return = [
            'type' => $SendRequest->type,
            'datetime' => \DateTime::createFromFormat('Y-m-d H:i:s', $SendRequest->created_at)->format('d/m/Y H:i'),
            'endpoint' => $SendRequest->endpoint,
            'request' => $SendRequest->request,
            'response' => $SendRequest->response
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

