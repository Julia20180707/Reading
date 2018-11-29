@extends("admin.layout.public")

@section("main")
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i>书籍信息修改</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Update Book</h4>
                        <form class="form-horizontal style-form" method="post" action="/admin/book_save" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$book->id}}">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">书名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="{{$book->title}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">作者</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="author" value="{{$book->author->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">分类</label>
                                <div class="col-sm-10">
                                    <select name="class_id" id="" class="form-control">
                                        @foreach($classifies as $classify)
                                            <option value="{{$classify->id}}" @if ($book->class_id == $classify->id) selected @endif>{{$classify->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">修改封面图</label>
                                <div class="col-sm-10 choose_directory">
                                    <input type="file" name="cover_pic" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">书籍简介</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="description" value="{{$book->description}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">作品信息</label>
                                <div class="col-sm-10">
                                    <textarea name="book_info" rows="6" class="form-control" style="resize: none">{{$book->book_info}}</textarea>
                                </div>
                            </div>

                            <br>
                            <button id="book_upload" class="btn btn-primary btn-lg btn-block">保存修改</button>
                        </form>
                    </div>
                </div><!-- col-lg-12-->
            </div>

        </section>
    </section>
@endsection
