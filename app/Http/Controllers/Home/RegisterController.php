<?php

namespace App\Http\Controllers\home;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    //加载注册页面
    public function index(){
        return view('home\register');
    }
    //执行注册操作
    public function register(Request $request){

        //验证
        $this->validate(request(),[
            'name'=>'required|unique:users,name|min:4|max:16',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|min:6|max:16|confirmed'

        ]);

        //将数据存放在data中
        $date = $request->except('_token','password_confirmation');

        //密码加密
        $date['password']=bcrypt($date['password']);

        //存储数据
        $res=User::create($date);

        if($res){
            return view('home/login');
        }else{
            return back()->with('error','注册失败');
        }

    }
}
