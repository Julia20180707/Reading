<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reading</title>
    <script src="/home/js/responsive.js"></script>
    <link rel="stylesheet" href="/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="/home/css/reset.css">
    <link rel="stylesheet" href="/home/css/setting.css">
    <link rel="stylesheet" href="/home/css/header.css">
    <link rel="stylesheet" href="/css/error.css">
</head>
<body>
<header>
    <div class="container">
        <div class="col-xs-4 addr"><a href="/mine"><span class="glyphicon glyphicon-menu-left"></span></a></div>
        <div class="col-xs-4 title">个人设置</div>
        <div class="col-xs-4 search"></div>
    </div>
</header>
<div class="header"></div>


<div class="container login_box bg">
    <div class="row ">
        <div class="row">
            <div class="login_group">
                <form action="/save_setting" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group user_pic_wrap col-xs-12">
                        <label for="exampleInputFile" id="label">
                            @if(\Auth::user()->photo=='')
                                <img src="/home/images/author1.png"  class="img-circle" id="img"/>
                            @else
                                <img src="/upload/{{\Auth::user()->photo}}"  class="img-circle" id="img"/>
                            @endif
                        </label>
                         <div class="position_wrap" style="position: absolute;bottom: 0.1rem;right: 39%">
                             <input type="file" id="exampleInputFile" style="opacity:0; filter:alpha(opacity=0); position:absolute; top:2px; right:0px" name="photo">
                         </div>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputEmail1" class="col-xs-3 text">用户名</label>
                        <input type="text" name="name" class="form-control col-xs-9" id="exampleInputEmail1" value="{{\Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"  class="col-xs-3 text">生日</label>
                        <input type="date" name="birthday" class="form-control col-xs-9" id="exampleInputPassword1" value="{{\Auth::user()->birthday}}">
                    </div>
                    <div class="checkbox">
                        <label class="col-xs-3 text">性别</label>
                        <label class=" col-xs-9">
                            <input type="radio" class="radio" name="sex" value="1" @if(\Auth::user()->sex==1) checked @endif>男
                            <input type="radio" class="radio" name="sex" value="2" @if(\Auth::user()->sex==2) checked @endif>女
                            <input type="radio" class="radio" name="sex" value="3" @if(\Auth::user()->sex==3) checked @endif>保密
                        </label>
                    </div>
                    <button  class="btn btn-success btn-lg setting_btn col-xs-offset-2" >保存修改</button>
                    <a class="btn btn-danger btn-lg setting_btn  col-xs-offset-1" href="/logout">退出登录</a>
                    @include('layout.error')
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/home/js/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#exampleInputFile").change(function () {
                var fil = this.files;
                for (var i = 0; i < fil.length; i++) {
                reads(fil[i]);
            }
        });
    });
    function reads(fil){
        var reader = new FileReader();
        reader.readAsDataURL(fil);
        reader.onload = function(){
            // document.getElementById("dd").innerHTML += "<img src='"+reader.result+"'>";
            $('#label').empty();
            $('#label').append("<img src='"+reader.result+"' class=\"img-circle\"  >");
        };
    }
</script>
</body>