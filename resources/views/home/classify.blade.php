{{--继承公共模板--}}
@extends('layout/public')

{{--替换顶部内容--}}
{{--替换顶部内容--}}
@section('title', '书籍分类')
@section('title_right', 'glyphicon glyphicon-comment')

{{--替换主体--}}
@section('main')
    <div class="container ">
        <div class="row ">
            <aside class="col-xs-2 nav">
                <nav class="nav_list">
                    @foreach($classifies as $classify)
                        <li><a href="/classify/{{$classify->id}}">{{$classify->title}}</a></li>
                    @endforeach
                </nav>
            </aside>
            <div class="col-xs-10 col-xs-offset-2 right_wrap">
                <div class="wrap">
                    <div class=" img_wrap">
                        <img src="/home/images/banner1.png"/>

                    </div>
                    <div class=" search_wrap">
                        <label class="col-xs-4"><a href="/popular" style="color: #af997d">  热门<input type="radio" name="option" @if($select==1) checked @endif></a></label>
                        <label class="col-xs-4"><a href="/recommend" style="color: #af997d">推荐<input type="radio" name="option" @if($select==2) checked @endif></a></label>
                        <label class="col-xs-4"><a href="/ranking" style="color: #af997d">  排行<input type="radio" name="option" @if($select==3) checked @endif></a></label>
                    </div>
                </div>
                <div class="wrap_stance"></div>
                <div class=" book_list">
                    @foreach($books as $book)
                        <a href="/book_detail/{{$book->id}}" class="book_info">
                            <div class="row">
                                <div class="col-xs-4 image">
                                    <img src="/{{$book->cover_pic}}"/>
                                </div>
                                <div class="col-xs-8 info">
                                    <h3>{{$book->title}}</h3>
                                    <h4>作者：{{$book->author->name}}</h4>
                                    <span>2456875人在读</span>
                                    <p>{{$book->description}}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="/home/js/jquery.min.js"></script>
<script>
    $(function () {
        $('.option').click(function () {

        })
    })
</script>