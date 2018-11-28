{{--继承公共模板--}}
@extends('layout/public')

{{--替换顶部内容--}}
{{--替换顶部内容--}}
@section('title', '热门作者')
@section('title_right', 'glyphicon glyphicon-share')

{{--替换主体--}}
@section('main')
    <!-- 作者信息开始 -->
    <div class="container user_info clearfix">
        <div class="row user_info_top">
            <div class="col-xs-3 icon">
                <img src="/home/images/author1.png" />
            </div>
            <div class="col-xs-9 name">
                <div class="information fl">
                    <h2>{{$author->name}}</h2>
                    <p>{{$author->address}}</p>
                </div>
                <div class="follow fr">
                    @if(\Auth::user())
                        @if(!$author->fan(\Auth::id(),$author->id)->exists())
                            <button><a href="/add_like_author/{{$author->id}}">关注</a></button>
                        @else
                            <button>已关注</button>
                        @endif
                    @else
                        <button><a href="/login">关注</a></button>
                    @endif

                </div>
            </div>
        </div>
        <p class="desc">{{$author->des}}</p>
    </div>
    <!-- 作者信息结束 -->


    <!-- 作品列表开始 -->
    <div class="container works_list">
        <h2>作品列表</h2>
        @foreach($books as $book)
            <div class="clearfix work_info">
                    <div class="col-xs-3 cover">
                        <img src="/home/images/1_20.png">
                    </div>
                <div class="col-xs-9">
                    <p class="work_time"><span class="cate">小说</span>{{$book->created_at->toFormattedDateString()}}</p>
                    <p class="title">{{$book->title}}</p>
                    <p class="tag">情感 女性向 大争议 现代</p>
                    <p class="hot_info">253人在读</p>
                    @if(\Auth::id())
                        @if(!$book->collect(\Auth::id())->exists())
                            <p class="star"><a href="/add_like_book/{{$book->id}}"><img src="/home/images/star_1.jpg"></a></p>
                        @else
                            <p class="star"><a><img src="/home/images/star_2.jpg"></a></p>
                        @endif
                    @else
                        <p class="star"><a href="/add_like_book/{{$book->id}}"><img src="/home/images/star_1.jpg"></a></p>
                    @endif
                    <p class="desc">{{$book->description}}</p>
                </div>
            </div>
        @endforeach
    </div>
    <!-- 作品列表结束 -->

    <!-- 读者留言开始 -->
    <div class="container messages_list">
        <h2>读者留言</h2>
        @foreach($comments as $comment)
            <div class="message_item clearfix">
                <div class="icon fl">
                    @if($comment->user->photo=='')
                        <img src="/home/images/1_27.png" />
                    @else
                        <img src="/upload/{{$comment->user->photo}}" />
                    @endif
                </div>
                <div class="message_info fr">
                    <p><span class="name">{{$comment->name}}</span> <span>{{$comment->created_at}}</span></p>
                    <p class="message">{{$comment->content}}</p>
                </div>
            </div>
        @endforeach
    </div>
    <!-- 读者留言结束 -->
@endsection