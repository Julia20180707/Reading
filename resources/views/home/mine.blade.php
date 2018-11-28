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
                <a href="#"><div class="col-xs-4"><img src="/home/images/mine_icon1.jpg"><br/>阅读记录</div></a>
                <a href="/collect"><div class="col-xs-4"><img src="/home/images/mine_icon1.jpg"><br/>收藏书籍</div></a>
                <a href="/fan"><div class="col-xs-4"><img src="/home/images/mine_icon1.jpg"><br/>关注作者</div></a>
            </div>
        </div>
        @else
            <div class="user_info">
                <div class="row">
                    <div class="col-xs-12 def_img">
                        <img src="/home/images/author1.png" alt="">
                    </div>
                    <div class="col-xs-4 col-xs-offset-4 text_wrap">
                        <a href="/login">请登录</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- 用户信息结束 --}}

    {{--关注更新开始--}}
    <div class="container   ">
        <div class="focus_updates">
            <h2>关注更新</h2>
            <div class="row book_info ">
                @if(!count($books))
                    <h2>还没有书籍哦</h2>
                @else
                    @foreach($books as $book)
                        <a href="/book_detail/{{$book->id}}">
                            <div class="col-xs-10 book_info_wrap">
                                <div class="col-xs-5 img_wrap">
                                    <img src="/{{$book->book->cover_pic}}"/>
                                </div>
                                <div class="col-xs-7 info">
                                    <h3>{{$book->book->title}}</h3>
                                    <h4>作者：{{$book->book->author->name}}</h4>
                                    <p>2456875人在读</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    {{--关注更新结束--}}
@endsection