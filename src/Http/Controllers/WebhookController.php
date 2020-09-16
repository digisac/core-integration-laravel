<?php

namespace DigiSac\Base\Http\Controllers;

use DigiSac\Base\Models\TraceRequest;
use DigiSac\Base\Models\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class WebhookController extends Controller
{

    public function index()
    {

        return view('core-integration-laravel::webhook.index');
    }

    public function data()
    {
        $data = Webhook::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                $date = \DateTime::createFromFormat('Y-m-d H:i:s', $row->created_at);
                return $date->format('d/m/Y H:i');
            })
            ->addColumn('payload', function ($row) {
                $code = '<code>' . $row->payload . '</code>';
                return $code;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-url="webhook" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Excluir</a>';
                return $btn;
            })
            ->rawColumns(['action','created_at','payload'])
            ->make(true);
    }

    public function destroy(Request $request, $id)
    {
        $Webhook = Webhook::find($id);
        $Webhook->delete();

        return redirect()->to('/webhook')->with(['message' => ['type' => 'success', 'message' => 'Requisiçao excluída com sucesso.']]);
    }

    public function history(Request $request, $id)
    {
        $Webhook = Webhook::find($id);
        $trace_requests = TraceRequest::where('id_webhook',$Webhook->id)->orderBy('created_at','DESC')->get();
        return view('core-integration-laravel::webhook.history')->with(['trace_requests' => $trace_requests])->render();
    }
}

