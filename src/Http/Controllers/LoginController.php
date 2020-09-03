<?php

namespace DigiSac\Base\Http\Controllers;

use App\User;
use DigiSac\Base\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(){
        return view('core-integration-laravel::login.index');
    }

    public function login(LoginRequest $request){
        //Check user exists
        $User = User::where('email',$request->get('email'))
            ->where('password',md5($request->get('password')))
            ->first();
        //Return error message
        if(!$User){
            return redirect()->back()->with(['message_error'=>'Email e/ou senha inválidos.']);
        }
        //Logs user
        Auth::login($User);

        return redirect()->to('/');
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('login');
    }
}
