<?php

namespace DigiSac\Base\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class WebhookController extends Controller
{

    public function index(){

        return view('core-integration-laravel::webhook.index');
    }

    public function data()
    {
        $data = DB::table('webhook')->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                $date = \DateTime::createFromFormat('Y-m-d H:i:s', $row->created_at);
                return $date->format('d/m/Y H:i');
            })
            ->addColumn('payload', function ($row) {
                $code = '<code>'.$row->payload.'</code>';
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
        $Webhook = DB::table('webhook')->delete($id);

        return redirect()->to('/webhook')->with(['message' => ['type' => 'success', 'message' => 'Requisiçao excluída com sucesso.']]);
    }
}
