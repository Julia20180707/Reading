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
    <link rel="stylesheet" href="/home/css/mine.css">
</head>
<body>
    <!-- 头部开始 -->
    <header>
        <div class="container">
            <div class="col-xs-4 addr"></div>
            <div class="col-xs-4 title">我的</div>
            <div class="col-xs-4 search"><span class="glyphicon glyphicon-comment"></span></div>
        </div>
    </header>
    <div class="header"></div>
    <!-- 头部结束 -->

    {{-- 用户信息开始 --}}
    <div class="container user_info clearfix main">
        <div class="row user_info_top">
            <div class="col-xs-3 icon">
                <img src="/home/images/author1.png" />
            </div>
            <div class="col-xs-9 name">
                <div class="information fl">
                    <h2>陈</h2>
                    <p>北京·海淀</p>
                </div>
                <button class="fr">设置</button>
            </div>
        </div>

        <div class="tag user_info_mid">
            <ul class="label_list clearfix">
                <li class="label_item fl">借书如山倒看书如抽丝</li>
                <li class="label_item fl">狮子座</li>
                <li class="label_item fl">推理控</li>
            </ul>
        </div>

        <div class="user_active user_info_bottom">
            <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">借阅记录</a></div>
            <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">收藏</a></div>
            <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">钱包</a></div>
            <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">优惠券</a></div>
        </div>
    </div>
    {{-- 用户信息结束 --}}

    {{--关注更新开始--}}
    <div class="container focus_updates  main">
        <h2>关注更新</h2>
        <div class="row book_info ">
            <div class="col-xs-6">
                <div class="col-xs-5">
                    <img src="/home/images/1_10.png"/>
                </div>
                <div class="col-xs-7 info">
                    <h3>杀死一只知更鸟</h3>
                    <h4>作者：【美】哈珀·李</h4>
                    <p>2456875人在读</p>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="col-xs-5">
                    <img src="/home/images/1_10.png"/>
                </div>
                <div class="col-xs-7 info">
                    <h3>杀死一只知更鸟</h3>
                    <h4>作者：【美】哈珀·李</h4>
                    <p>2456875人在读</p>
                </div>
            </div>
        </div>

    </div>
    {{--关注更新结束--}}

    {{--底部开始--}}
    <footer>
        <div class="container">
            <div class="row footer_btn">
                <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">主页</a></div>
                <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">分类</a></div>
                <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">书单</a></div>
                <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">我的</a></div>
            </div>
        </div>
    </footer>
    {{--底部结束--}}
</body>
</html>