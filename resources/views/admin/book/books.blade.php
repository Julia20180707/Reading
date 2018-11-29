@extends("admin.layout.public")

@section("main")
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i>管理书籍</h3>
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover" style="text-align: center;">
                            <h4><i class="fa fa-angle-right"></i>分类列表</h4>
                            <hr>
                            <thead>
                                <tr>
                                    <th style="text-align: center;"><i class="fa fa-bullhorn"></i>　编号</th>
                                    <th style="text-align: center;" class="hidden-phone"><i class="fa fa-book"></i>　书名</th>
                                    <th style="text-align: center;" class="hidden-phone"><i class="fa fa-user"></i>　作者</th>
                                    <th style="text-align: center;" class="hidden-phone"><i class="fa fa-clipboard"></i>　分类</th>
                                    <th style="text-align: center;" class="hidden-phone"><i class="fa fa-image"></i>　书籍封面</th>
                                    <th style="text-align: center;" class="hidden-phone"><i class="fa fa-info"></i>　书籍简介</th>
                                    <th style="text-align: center;" class="hidden-phone"><i class="fa fa-info-circle"></i>　作品信息</th>
                                    <th style="text-align: center;"><i class=" fa fa-edit"></i>　操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td style="vertical-align: middle;">{{$book->id}}</td>
                                    <td class="hidden-phone" style="vertical-align: middle;">{{$book->title}}</td>
                                    <td class="hidden-phone" style="vertical-align: middle;">{{$book->author->name}}</td>
                                    <td class="hidden-phone" style="vertical-align: middle;">{{$book->classifies->title}}</td>
                                    <td class="hidden-phone" style="vertical-align: middle;">
                                        <img src="/{{$book->cover_pic}}" alt="" style="width: 100px; height: 155px;">
                                    </td>
                                    <td class="hidden-phone" style="vertical-align: middle;">
                                        <p style="display: inline-block; width: 444px; margin: 0;">{{$book->description}}"</p>
                                    </td>
                                    <td class="hidden-phone" style="vertical-align: middle;">
                                        <p style="display: inline-block; width: 444px; margin: 0;">{{$book->book_info}}</p>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a href="/admin/book_edit/{{$book->id}}"><button class="btn btn-primary btn-xs" title="编辑"><i class="fa fa-pencil"></i></button></a>
                                        <a href="/admin/book_delete/{{$book->id}}"><button class="btn btn-danger btn-xs" title="删除"><i class="fa fa-trash-o"></i></button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /content-panel -->
                    <div style="text-align: center">{{$books->links()}}</div>
                </div><!-- /col-md-12 -->
            </div>
        </section>
    </section>
@endsection
