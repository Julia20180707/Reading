{{--继承公共模板--}}
@extends('layout/public')

{{--替换顶部内容--}}
{{--替换顶部内容--}}
@section('title', '收藏书籍')
@section('title_right', 'glyphicon glyphicon-comment')

{{--替换主体--}}
@section('main')

    {{--关注更新开始--}}
    <div class="container   ">
        <div class="focus_updates">
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
                                    <a href="/un_like_book/{{$book->book->id}}" class="btn btn-default" style="margin-top: 0.2rem">取消收藏</a>
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