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
    <link rel="stylesheet" href="/home/css/header.css">
    <link rel="stylesheet" href="/home/css/footer.css">
    <link rel="stylesheet" href="/home/css/index.css">
    <link rel="stylesheet" href="/home/css/mine.css">
    <link rel="stylesheet" href="/home/css/classify.css">
    <link rel="stylesheet" href="/home/css/book_detail.css">
    <script>
        $(function () {
            $('#back').click(function () {
                history.back(-1);
            })
        })

    </script>
</head>
<body>
<header>
    <div class="container">
        <div class="col-xs-4 addr"><a href="/classify" id="back"><span class="glyphicon glyphicon-menu-left"></span></a></div>
        <div class="col-xs-4 title">书籍详情</div>
        <div class="col-xs-4 search"></div>
    </div>
</header>
<div class="header"></div>


    <div class="container">
        {{-- 图书信息开始 --}}
        <div class="row book_info clearfix">
            <div class="row book_info_top">
                <div class="col-xs-3 icon">
                    <img src="/{{$book->cover_pic}}" />
                </div>
                <div class="col-xs-9 info">
                    <div class="information fl ">
                        <h2><span class="user_tag">随笔</span>{{$book->title}}</h2>
                        <a href="/author/{{$book->author->id}}">
                            <h4>作者：{{$book->author->name}}</h4>
                        </a>
                        <p>{{$book->created_at}}</p>
                        <span>254682人看过</span>
                    </div>
                    <a href="/read/{{$book->directory}}/{{$chapter_name}}"><button class="btn read_btn" style="color: #fff;">阅读</button></a>
                    <div class="book_tag_list fr ">
                        @if(!\Auth::id())
                            <a href="/login"> <i class="glyphicon glyphicon-thumbs-up"></i></a><span>{{$book->zans_count}}</span>
                        @else
                            @if(!$book->zan(\Auth::id())->exists())
                                <a href="/book/{{$book->id}}/zan"> <i class="glyphicon glyphicon-thumbs-up"></i></a><span>{{$book->zans_count}}</span>
                            @else
                                <a href="/book/{{$book->id}}/unzan">  <i class="glyphicon glyphicon-thumbs-down"></i></a><span>{{$book->zans_count}}</span>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="row  book_info_des">
                <div class="col-xs-12">
                    <p>
                        {{$book->description}}
                    </p>
                </div>
            </div>
        </div>

        {{-- 图书信息结束 --}}

        {{--介绍--}}
        <div class="row c_editor peo">
            <div class="col-xs-12">
                <h3>介绍：</h3>
                <p>
                    {{$book->book_info}}
                </p>
            </div>
        </div>
        {{--介绍--}}




        {{--读者--}}
        <div class="row reader peo">
            <div class=" reader_top">
                <div class="col-xs-9">
                    <h3>读者：</h3>
                </div>
                <div class="col-xs-3">
                    <button class="btn"  data-target="#comment_model" id="com_btn" >评论</button>
                </div>
            </div>
            <div class="  reader_middle" id="reader_middle">
                @foreach($comments as $comment)
                    <div class="row reader_middle_wrap">
                        <div class="row">
                            <div class="col-xs-3 reader_img">
                                @if($comment->user->photo=='')
                                    <img src="/home/images/author1.png" />
                                @else
                                    <img src="/upload/{{$comment->user->photo}}" />
                                @endif
                            </div>
                            <div class="col-xs-9 reader_comment">
                                <h4>{{$comment->user->name}}</h4><span>{{$comment->created_at}}</span>
                                <p>
                                    {{$comment->content}}
                                </p>
                            </div>
                        </div>
                        <div class="row icon">
                            <div class="col-xs-9"></div>
                            <div class="col-xs-3">
                                @if(!\Auth::id())
                                    <a href="/login"  id="{{$comment->id}}"> <i class="glyphicon glyphicon-thumbs-up"></i></a><span>{{$comment->zans_count}}</span>
                                @else
                                    @if(!$comment->zan($comment->id,\Auth::id())->exists())
                                        <a href="/comment/{{$comment->id}},{{$book->id}}/zan"  id="{{$comment->id}}"> <i class="glyphicon glyphicon-thumbs-up"></i></a><span>{{$comment->zans_count}}</span>
                                    @else
                                        <a href="/comment/{{$comment->id}}/unzan"  id="{{$comment->id}}">  <i class="glyphicon glyphicon-thumbs-down"></i></a><span>{{$comment->zans_count}}</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class=" reader_bottom">
                <div class="menu_wrap"  id="add_more">
                    <span>{{$book->comments_count}}</span>
                    <img src="/home/images/menu.png"/>
                </div>
            </div>
        </div>
        {{--读者--}}



        {{--点击打开评论--}}
        <div class="user_oper_model"></div>
            <div class="row user_oper">
                @if(\Auth::id())
                    @if(!$book->collect(\Auth::id())->exists())
                        <div class="col-xs-6 collec"><a href="/add_like_book/{{$book->id}}">收藏</a></div>
                    @else
                        <div class="col-xs-6 collec"><a>已收藏</a></div>
                    @endif
                    @if(!$book->bookcase(\Auth::id())->exists())
                        <div class="col-xs-6 add_bookshelf"><a href="/add_book/{{$book->id}}">加到书架</a></div>
                    @else
                        <div class="col-xs-6 add_bookshelf"><a>已到书架</a></div>
                    @endif
                @else
                    <div class="col-xs-6 collec"><a href="/login">收藏</a></div>
                    <div class="col-xs-6 add_bookshelf"><a href="/login">加到书架</a></div>
                @endif
            </div>
        </div>
        {{--点击打开评论--}}

    </div>


{{--模态层--}}
<div class="modal fade" id="comment_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">评论</h4>
            </div>
            <div class="modal-body">
                <form action="/book_comment/{{$book->id}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="message-text" class="control-label">评论内容:</label>
                        <textarea class="form-control" id="message-text" name="content"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">发布评论</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
<script src="/home/js/jquery.min.js"></script>
<script src="/home/js/bootstrap.min.js"></script>
<script>
    $(function(){
        $('#com_btn').click(function(){
            $('#comment_model').modal();
        })
    })

    $('#add_more').click(function(){
        $('#reader_middle').css('height','auto');
    })
</script>

</html>