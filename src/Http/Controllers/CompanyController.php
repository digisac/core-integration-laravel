<?php

namespace DigiSac\Base\Http\Controllers;

use DigiSac\Base\Http\Requests\CompanyRequest;
use DigiSac\Base\Models\Company;
use DigiSac\Base\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{

    public function index()
    {
        return view('core-integration-laravel::company.index');
    }

    public function data()
    {
        $data = Company::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('url', function ($row) {
                $url = '<b>' . $row->url . '</b>';
                return $url;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('company.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Editar</a>
                        <a href="javascript:void(0)" data-url="company" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Excluir</a>';
                return $btn;
            })
            ->rawColumns(['action', 'url'])
            ->make(true);
    }

    public function create()
    {
        return view('core-integration-laravel::company.create');
    }

    public function store(CompanyRequest $request)
    {
        $Company = new Company();
        $Company->id = file_get_contents('/proc/sys/kernel/random/uuid');
        $Company->fill($request->all());
        $Company->save();

        return redirect()->to('/company')->with(['message' => ['type' => 'success', 'message' => 'Empresa criada com sucesso.']]);
    }

    public function edit(Request $request, $id)
    {
        $Company = Company::find($id);
        return view('core-integration-laravel::company.edit')->with(['Company' => $Company]);
    }

    public function update(CompanyRequest $request, $id)
    {
        $Company = Company::find($id);
        $Company->fill($request->all());
        $Company->update();

        return redirect()->to('/company')->with(['message' => ['type' => 'success', 'message' => 'Empresa alterada com sucesso.']]);
    }

    public function destroy(Request $request, $id)
    {
        $Company = Company::find($id);
        $Company->delete();

        return redirect()->to('/company')->with(['message' => ['type' => 'success', 'message' => 'Empresa excluída com sucesso.']]);
    }

    /*
     * Select Company
     */
    public function change(Request $request, $id)
    {
        $Company = Company::find($id);

        \Session::put('SelectedCompany', $Company);

        return redirect()->to('/')->with(['message' => ['type' => 'success', 'message' => 'Você está agora visualizando a empresa <strong>' . $Company->name . '</strong>.']]);
    }
}
