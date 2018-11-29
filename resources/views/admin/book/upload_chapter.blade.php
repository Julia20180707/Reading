@extends("admin.layout.public")

@section("main")
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i>上传章节</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Upload New Chapter</h4>
                        <form class="form-horizontal style-form" method="post" action="/admin/chapter_save" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">书名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="book_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">作者</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="author">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">章节编号</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="chapter_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">选择章节<span style="color: red;">（请上传 TXT 文档）</span></label>
                                <div class="col-sm-10 choose_directory">
                                    <input type="file" name="chapter" />
                                </div>
                            </div>
                            <br>
                            <button id="book_upload" class="btn btn-primary btn-lg btn-block">上传该章节</button>
                        </form>
                    </div>
                </div><!-- col-lg-12-->
            </div>

        </section>
    </section>
@endsection
