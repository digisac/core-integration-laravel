<?php

namespace DigiSac\Base\Http\Controllers;

use DigiSac\Base\Http\Requests\CompanyRequest;
use DigiSac\Base\Models\Company;
use DigiSac\Base\Models\User;
use DigiSac\Base\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanyApiController extends Controller
{
    public function __construct(Request $request){
        $this->validateToken($request);
    }

    public function validateToken($request){
        if (!$request->token_api or !User::where('token_api', $request->token_api)->first()) {
            abort(401, 'Unauthenticated');
        }
    }

    public function store(Request $request)
    {
        if($request->has(['name', 'url', 'token', 'company_id', 'company_agnus_id', 'settings'])){
            $Company = new Company();
            $Company->id = file_get_contents('/proc/sys/kernel/random/uuid');
            $Company->fill($request->all());
            $Company->save();

            return response()->json(['status' => 'success', 'data' => $Company], 201);
        } else {
            return response()->json(['error' => 'Parâmetros obrigatórios não informados.', 'params' => 'name, url, token, company_id, company_agnus_id, settings'], 422);
        }
    }

    public function list(Request $request)
    {
        return Company::orderBy('created_at', 'DESC')->get();
    }

    public function update(Request $request, $id)
    {
        if($request->has(['name', 'url', 'token', 'company_id', 'company_agnus_id', 'settings'])){
            $Company = Company::find($id);

            $Company->fill($request->all());
            $Company->save();

            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['error' => 'Parâmetros obrigatórios não informados.', 'params' => 'name, url, token, company_id, company_agnus_id, settings'], 422);
        }
    }

    public function destroy(Request $request, $id)
    {
        $Company = Company::find($id);
        $Company->delete();

        return response()->json(['status' => 'success'], 200);
    }
}
