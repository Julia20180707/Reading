@extends("admin.layout.public")

@section("main")
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i>编辑分类</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> 修改分类</h4>
                        <form class="form-horizontal style-form" method="post" action="/admin/classify_save">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$classify->id}}">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="{{$classify->title}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">点击保存该分类</button>
                        </form>
                    </div>
                </div><!-- col-lg-12-->
            </div>
        </section>
    </section>
@endsection
