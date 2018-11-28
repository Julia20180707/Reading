<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login(){
        return view('admin\user\login');
    }

    public function dologin(Request $request){
        $text=$request->name;
        if (Auth::guard("admin")->attempt(['name' =>$text, 'password' => request('password')])) {
            // 认证通过...
            return redirect('/admin/index');
        }else{
            return back();
        }
    }
}
