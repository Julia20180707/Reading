<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reading</title>
    <script src="/home/js/jquery.min.js"></script>
    <script src="/home/js/responsive.js"></script>
    <link rel="stylesheet" href="/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="/home/css/reset.css">
    <link rel="stylesheet" href="/home/css/login.css">
    <link rel="stylesheet" href="/home/css/header.css">
    <link rel="stylesheet" href="/css/error.css">
</head>
<body>
<!-- 头部开始 -->
<header>
    <div class="container">
        <div class="col-xs-4 addr"><a href="/index"><i class="glyphicon glyphicon-menu-left"></i></a></div>
        <div class="col-xs-4 title">登录</div>
        <div class="col-xs-4 search"></div>
    </div>
</header>
<div class="header"></div>
<!-- 头部结束 -->
<div class="container login_box bg">
    <div class="row ">
        <div class="col-xs-12 user_pic_wrap">
            <img src="/home/images/author1.png" alt="">
        </div>
        <div class="row">
            <div class="login_group">
                <form action="/login" method="post">
                    {{csrf_field()}}
                    <input type="text" class="form-control" placeholder="username/email" name="name" id="login_name"><br/>
                    <input type="password" class="form-control" placeholder="password" name="password">
                    <button type="submit" class="btn btn-success login_btn col-xs-offset-3" >登录</button>
                    <a href="/register" class="btn" style="margin-top: 1rem">注册</a>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script>
    {{--$('#login_name').keyup(function(){--}}
        {{--var value= $(this).val();--}}

        {{--$.post("/dologin/" + value, {"_token": "{{csrf_token()}}"}, function (data) {--}}
            {{--//判断是否删除成功--}}
            {{--if (data == "OK") {--}}
                {{--alert("");--}}
            {{--} else {--}}
                {{--alert("");--}}
            {{--}--}}
        {{--})--}}
    {{--})--}}



</script>