<?php

namespace App\Http\Controllers\Home;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //显示我的页面
    public function index(){

        return view('home/mine');
    }

    //进行个人信息修改
    public function setting(){
        return view('home/setting');
    }

    //个人信息修改保存操作
    public function save_setting(Request $request){


        $user = User::find(\Auth::user()->id);

        if($user->name==$request['name']){
            $this->validate(request(),[
                'name'=>'required|min:4|max:16'
            ]);
        }else{
            $this->validate(request(),[
                'name'=>'required|unique:users,name|min:4|max:16'
            ]);
        }

        //将数据存放在data中
        $date = $request->except('_token');

        // 图片上传路径
        $path=base_path("public\upload\\");

        // 原图片路径
        $old_icon = $path.Auth::user()->photo;

        $exist = Auth::user()->photo;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');  //获取UploadFile实例

            if ( $file->isValid()) { //判断文件是否有效

                //1 上传图片
                $ext = $file->getClientOriginalExtension(); //扩展名
                $file_name = time() . "." . $ext;    //重命名
                $res=$file->move($path, $file_name); //将上传文件移动至指定目录


                // 2 把图片保存到数据库
                $date['photo']=$file_name;

                // 3 删除原图
                if($exist){
                    unlink($old_icon);
                }
            }
        }



        User::where('id', $user->id)
            ->update($date);

        return redirect('/setting');
    }
}
