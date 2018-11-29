{{--继承公共模板--}}
@extends('layout/public')

{{--替换顶部内容--}}
{{--替换顶部内容--}}
@section('title_left', 'glyphicon glyphicon-menu-left')
@section('title', '关注作者')
@section('title_right', 'glyphicon glyphicon-comment')

{{--替换主体--}}
@section('main')

    {{--关注更新开始--}}
    <div class="container   ">
        <div class="focus_updates">
            <div class="row book_info ">
                @if(!count($authors))
                    <h2>还没有关注哦</h2>
                @else
                    @foreach($authors as $author)
                        <div class="col-xs-12 book_info_wrap">
                            <div class="col-xs-5 img_wrap">
                                <img src="/home/images/author1.png" style="width:2rem;height: 2rem;border-radius: 50%;margin-bottom: 0.5rem"/>
                                <a href="/un_fan/{{$author->author->id}}" class="btn btn-default">取消关注</a>
                            </div>
                            <div class="col-xs-7 info" >
                                <h3>姓名：{{$author->author->name}}</h3>
                                <h4>地址：{{$author->author->address}}</h4>
                                <p>介绍：{{$author->author->des}}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>


    </div>
    {{--关注更新结束--}}
@endsection