<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //加载登录页面
    public function index(){
        return view('home\login');
    }

    //执行用户登录
    public function login(Request $request){
        $text=$request->name;
        if (Auth::guard("web")->attempt(['name' =>$text, 'password' => request('password')])) {
            // 认证通过...
            return redirect('/index');
        }else{
            if(Auth::guard("web")->attempt(['email' =>$text, 'password' => request('password')])){
                return redirect('/index');
            }else{
                return back();
            }
        }
    }



    //执行用户退出
    public function logout(){

        //执行退出登录

        Auth::logout();

        return redirect('/login');
    }
}
