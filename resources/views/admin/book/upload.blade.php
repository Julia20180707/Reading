@extends("admin.layout.public")

@section("main")
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i>上传新书</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Upload New Book</h4>
                        <form class="form-horizontal style-form" method="post" action="/admin/books_upload" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">书名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">作者</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="author">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">分类</label>
                                <div class="col-sm-10">
                                    <select name="class_id" id="" class="form-control">
                                        @foreach($classifies as $classify)
                                        <option value="{{$classify->id}}">{{$classify->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">添加封面图</label>
                                <div class="col-sm-10 choose_directory">
                                    <input type="file" name="cover_pic" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">选择书籍压缩包 <span style="color: red;">（请上传 Zip 文档）</span></label>
                                <div class="col-sm-10 choose_directory">
                                    {{--<input type="file" title="点击选择文件夹" multiple webkitdirectory name="book_content" />--}}
                                    <input type="file" title="点击选择压缩包" name="book_content" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">书籍简介</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">作品信息</label>
                                <div class="col-sm-10">
                                    <textarea name="book_info" rows="6" class="form-control" style="resize: none"></textarea>
                                </div>
                            </div>

                            <br>
                            <button id="book_upload" class="btn btn-primary btn-lg btn-block">上传该书籍</button>
                        </form>
                    </div>
                </div><!-- col-lg-12-->
            </div>

        </section>
    </section>
@endsection
