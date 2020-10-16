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
        $webhooks = Webhook::orderBy('created_at', 'DESC')->paginate(20);
        return view('core-integration-laravel::webhook.index')->with([
            'webhooks' => $webhooks
        ]);
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
        $trace_requests = TraceRequest::where('id_webhook', $Webhook->id)->orderBy('created_at', 'DESC')->get();
        return view('core-integration-laravel::webhook.history')->with(['trace_requests' => $trace_requests])->render();
    }
}

