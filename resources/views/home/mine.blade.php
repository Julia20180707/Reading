{{--继承公共模板--}}
@extends('layout/public')

{{--替换顶部内容--}}
{{--替换顶部内容--}}
@section('title', '我的')
@section('title_right', 'glyphicon glyphicon-comment')

{{--替换主体--}}
@section('main')
    {{-- 用户信息开始 --}}
    <div class="container">
        @if(\Auth::user())
        <div class=" user_info ">
            <div class="row user_info_top">
                <div class="col-xs-3 icon">
                    @if(\Auth::user()->photo=='')
                        <img src="/home/images/author1.png" />
                    @else
                        <img src="/upload/{{\Auth::user()->photo}}" />
                    @endif

                </div>
                <div class="col-xs-9 name">
                    <div class="information fl">
                        <h2>{{\Auth::user()->name}}</h2>
                        <p>阅读时长：{{\Auth::user()->duration}}</p>
                    </div>
                    <button class="fr"><a href="/setting">设置</a></button>
                </div>
            </div>
            <div class="tag user_info_mid">
                <ul class="label_list clearfix">
                    <li class="label_item fl">借书如山倒看书如抽丝</li>
                    <li class="label_item fl">狮子座</li>
                    <li class="label_item fl">推理控</li>
                </ul>
            </div>
            <div class="row user_active user_info_bottom">
                <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">借阅记录</a></div>
                <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">收藏</a></div>
                <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">钱包</a></div>
                <div class="col-xs-3"><img src="/home/images/mine_icon1.jpg"><br/><a href="#">优惠券</a></div>
            </div>
        </div>
        @else

        @endif
    </div>

    {{-- 用户信息结束 --}}

    {{--关注更新开始--}}
    <div class="container   ">
        <div class="focus_updates">
            <h2>关注更新</h2>
            <div class="row book_info ">
                <div class="col-xs-10 book_info_wrap">
                    <div class="col-xs-5 img_wrap">
                        <img src="/home/images/1_10.png"/>
                    </div>
                    <div class="col-xs-7 info">
                        <h3>杀死一只知更鸟</h3>
                        <h4>作者：【美】哈珀·李</h4>
                        <p>2456875人在读</p>
                    </div>
                </div>
                <div class="col-xs-10 book_info_wrap">
                    <div class="col-xs-5 img_wrap">
                        <img src="/home/images/1_10.png"/>
                    </div>
                    <div class="col-xs-7 info">
                        <h3>杀死一只知更鸟</h3>
                        <h4>作者：【美】哈珀·李</h4>
                        <p>2456875人在读</p>
                    </div>
                </div>
                <div class="col-xs-10 book_info_wrap">
                    <div class="col-xs-5 img_wrap">
                        <img src="/home/images/1_10.png"/>
                    </div>
                    <div class="col-xs-7 info">
                        <h3>杀死一只知更鸟</h3>
                        <h4>作者：【美】哈珀·李</h4>
                        <p>2456875人在读</p>
                    </div>
                </div>
                <div class="col-xs-10 book_info_wrap">
                    <div class="col-xs-5 img_wrap">
                        <img src="/home/images/1_10.png"/>
                    </div>
                    <div class="col-xs-7 info">
                        <h3>杀死一只知更鸟</h3>
                        <h4>作者：【美】哈珀·李</h4>
                        <p>2456875人在读</p>
                    </div>
                </div>
                <div class="col-xs-10 book_info_wrap">
                    <div class="col-xs-5 img_wrap">
                        <img src="/home/images/1_10.png"/>
                    </div>
                    <div class="col-xs-7 info">
                        <h3>杀死一只知更鸟</h3>
                        <h4>作者：【美】哈珀·李</h4>
                        <p>2456875人在读</p>
                    </div>
                </div>
                <div class="col-xs-10 book_info_wrap">
                    <div class="col-xs-5 img_wrap">
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


    </div>
    {{--关注更新结束--}}
@endsection