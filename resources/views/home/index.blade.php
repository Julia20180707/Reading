{{--继承公共模板--}}
@extends('layout/public')

{{--替换顶部内容--}}
{{--替换顶部内容--}}
@section('title_left', '观典国际')
@section('title', '灯慕')
@section('title_right', 'glyphicon glyphicon-search')

{{--替换主体--}}
@section('main')
    <!-- 附近热门开始 -->
    <div class="container nearby clearfix">
        <div class="headline clearfix">
            <h3 class="nb_hot fl">附近热门</h3>
            <p class="fr"><span class="fl">32</span><img src="/home/images/menu.png" class="fl"></p>
        </div>
        <div class="hot_item_wrap clearfix">
            @foreach($books as $book)
            <a class="hot_item fl" href="/book_detail/{{$book->id}}">
                <img src="/{{$book->cover_pic}}" alt="" class="fl">
                <div class="fr describe">
                    <p class="title">{{$book->title}}</p>
                    <p class="author">作者：{{$book->u_author->name}}</p>
                    <p class="comment">这个世界的规则有时候是不可思议的。被伤害的人被责怪，加害者却高枕无忧。</p>
                    <p class="c_user fr">—毛菇菇评</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <!-- 附近热门结束 -->

    <!-- 广告 -->
    <div class="container add">
        <img src="/home/images/banner1.png" />
    </div>

    <!-- 灯幕榜单开始 -->
    <div class="container recommend">
        <h2>灯幕榜单</h2>
        <div class="row">
            <div class="col-xs-4 class_item">
                <h4>总榜</h4>
                <div class="rec_item">
                    <img src="/home/images/1_10.png" />
                    <p class="title">杀死一只知更鸟</p>
                    <p class="author">[美]哈珀·李</p>
                </div>
                <div class="rec_item">
                    <img src="/home/images/1_19.png" />
                    <p class="title">杀死一只知更鸟</p>
                    <p class="author">[美]哈珀·李</p>
                </div>
                <div class="rec_item">
                    <img src="/home/images/1_25.png" />
                    <p class="title">杀死一只知更鸟</p>
                    <p class="author">[美]哈珀·李</p>
                </div>
                <img src="/home/images/menu.png" class="menu" />
            </div>
            <div class="col-xs-4 class_item">
                <h4>高分榜</h4>
                <div class="rec_item">
                    <img src="/home/images/1_12.png" />
                    <p class="title">杀死一只知更鸟</p>
                    <p class="author">[美]哈珀·李</p>
                </div>
                <div class="rec_item">
                    <img src="/home/images/1_20.png" />
                    <p class="title">杀死一只知更鸟</p>
                    <p class="author">[美]哈珀·李</p>
                </div>
                <div class="rec_item">
                    <img src="/home/images/1_26.png" />
                    <p class="title">杀死一只知更鸟</p>
                    <p class="author">[美]哈珀·李</p>
                </div>
                <img src="/home/images/menu.png" class="menu" />
            </div>
            <div class="col-xs-4 class_item">
                <h4>新书榜</h4>
                <div class="rec_item">
                    <img src="/home/images/1_14.png" />
                    <p class="title">杀死一只知更鸟</p>
                    <p class="author">[美]哈珀·李</p>
                </div>
                <div class="rec_item">
                    <img src="/home/images/1_21.png" />
                    <p class="title">杀死一只知更鸟</p>
                    <p class="author">[美]哈珀·李</p>
                </div>
                <div class="rec_item">
                    <img src="/home/images/1_27.png" />
                    <p class="title">杀死一只知更鸟</p>
                    <p class="author">[美]哈珀·李</p>
                </div>
                <img src="/home/images/menu.png" class="menu" />
            </div>
        </div>
    </div>
    <!-- 灯幕榜单结束 -->

    <!-- 热门作者开始 -->
    <div class="container hot_author">
        <h2>热门作者</h2>
        <div class="clearfix author_info">
            <a href="/author_detail">
                <div class="col-xs-3 col-sm-4 col-md-4">
                    <img src="/home/images/author1.png" />
                </div>
               <div class="col-xs-9 col-sm-8 col-md-8 information">
                   <p><span class="name">阿雅</span><span>粉丝 <strong>20452</strong></span></p>
                   <p class="desc">著名主持人，4年前跨界操刀进入码字界，不想一炮而红，时隔2年带着新书《所有流过的眼泪》回归大众视野，书中她毫无保留的剖析了自己的历程，消沉...</p>
               </div>
            </a>
        </div>
    </div>
    <!-- 热门作者结束 -->

    <!-- 广告 -->
    <div class="container add">
        <img src="/home/images/banner2.png" />
    </div>

    <!-- 灯幕热门开始 -->
    <div class="container hot_reading">
        <h2>灯幕热门</h2>
        @foreach($all_books as $book)
            <a href="/book_detail/{{$book->id}}">
                <div class="clearfix reading_info">
                    <div class="col-xs-3 cover">
                        <img src="/{{$book->cover_pic}}">
                    </div>
                    <div class="col-xs-9">
                        <p class="title">{{$book->title}}</p>
                        <p class="author">作者：<span>{{$book->u_author->name}}</span></p>
                        <p class="hot_info">253254人在读</p>
                        <p class="desc">{{$book->description}}</p>
                    </div>
                </div>
            </a>
        @endforeach
        <img src="/home/images/menu.png" class="menu" />
    </div>
    <!-- 灯幕热门结束 -->
@endsection