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
    <link rel="stylesheet" href="/home/css/register.css">
    <link rel="stylesheet" href="/home/css/header.css">
    <link rel="stylesheet" href="/css/error.css">
    <script src="/js/responsive.js"></script>
</head>
<body>
<!-- 头部开始 -->
<header>
    <div class="container">
        <div class="col-xs-4 addr"><a href="/mine"><i class="glyphicon glyphicon-menu-left"></i></a></div>
        <div class="col-xs-4 title">用户注册</div>
        <div class="col-xs-4 search"></div>
    </div>
</header>
<!-- 头部结束 -->
<div class="container login_box bg">
    <div class="row ">
        <div class="col-xs-12 user_pic_wrap">
            {{--<img src="/home/images/author1.png" alt="">--}}
        </div>
        <div class="row">
            <div class="login_group">
                <form action="/register" method="post">
                    {{csrf_field()}}
                    {{--<input type="hidden" _token="" name="_token" value="">--}}
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-xs-3 text">用户名：</label>
                        <input type="text" class="form-control col-xs-8" placeholder="username" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-xs-3 text">邮箱：</label>
                        <input type="email" class="form-control col-xs-8" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-xs-3 text">密码：</label>
                        <input type="password"  class="form-control col-xs-8"  placeholder="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-xs-3 text">确认密码：</label>
                        <input type="password"  class="form-control col-xs-8" placeholder="password" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-success btn-lg register_btn col-xs-offset-3" >注册</button>
                    @include('layout.error')
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>