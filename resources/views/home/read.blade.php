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
    <style type="text/css">
        body {
            background-color: #faecde;
        }
        .catalog {
            height: 95vh;
            overflow-y: scroll;
        }
        #pull {
            width: 1rem;
            height: 0.6rem;
            border-radius: 0.1rem;
            text-align: center;
            line-height: 0.6rem;
            background-color: rgba(0,0,0,.2);
            position: fixed;
            bottom: 8%;
            right: 0.3rem;
        }
    </style>
</head>
<body>
    <div id="pull">目录</div>
    <input type="hidden" id="directory" name="directory" value="{{$directory}}">
    <aside class="col-xs-3 nav catalog">
        <nav class="nav_list">
            <a href="/index"><li style="color: #8b847e;">主页</li></a>
            @foreach($chapters as $chapter)
                <a href="/read/{{$directory}}/{{$chapter->chapter_name}}"><li style="color: #8b847e;">第{{$chapter->chapter_id}}章</li></a>
            @endforeach
        </nav>
    </aside>

    <div class="container">
        <div class="row trial_read peo">
            <div class="text">
                <p class="content" style="font-size: 0.28rem; line-height: 0.5rem; padding-bottom: 1.5rem">{{$contents}}</p>
            </div>
            <div class="row user_oper">
                @if(isset($chapter_name_prev))
                    <a href="/read/{{$directory}}/{{$chapter_name_prev}}">
                @else
                    <a href="#">
                @endif
                        <div class="col-xs-6 collec prev" style="color: #8b847e;">上一章</div>
                    </a>

                @if(isset($chapter_name_next))
                    <a href="/read/{{$directory}}/{{$chapter_name_next}}">
                @else
                    <a href="#">
                @endif
                        <div class="col-xs-6 add_bookshelf next" style="color: #fff;">下一章</div>
                    </a>
            </div>
        </div>
    </div>

    <script src="/home/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(".catalog").animate({left:"-150px"}, 0);
        $("#pull").click(function(){
            if($(".catalog").css("left") == "0px") {
                $(".catalog").animate({left:"-150px"});
            } else {
                $(".catalog").animate({left:"0px"});
            }
        });
    </script>
</body>
</html>