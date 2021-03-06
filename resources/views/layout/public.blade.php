<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reading</title>
    <script src="/home/js/jquery.min.js"></script>
    <script src="/home/js/responsive.js"></script>
    <link rel="stylesheet" href="/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="/home/css/reset.css">
    <link rel="stylesheet" href="/home/css/header.css">
    <link rel="stylesheet" href="/home/css/footer.css">
    <link rel="stylesheet" href="/home/css/mine.css">
    <link rel="stylesheet" href="/home/css/book_detail.css">
    <link rel="stylesheet" href="/home/css/classify.css">
    <link rel="stylesheet" href="/home/css/setting.css">
    <link rel="stylesheet" href="/home/css/index.css">
    <link rel="stylesheet" href="/home/css/author.css">
    <script>
        $(function () {
            $('#back').click(function () {
                history.back(-1);
            })
        })

    </script>
</head>
<body>

{{--这里是网页header导航栏--}}
@include('layout.header')

{{--这里是网页左侧主体--}}
@section('main')
@show


{{--这里是网页底部--}}
@include('layout.footer')

</body>
</html>