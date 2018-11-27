@extends("admin.layout.public")

@section("main")
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i>管理分类</h3>
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover" style="text-align: center;">
                            <h4><i class="fa fa-angle-right"></i>分类列表</h4>
                            <hr>
                            <thead>
                            <tr>
                                <th style="text-align: center;"><i class="fa fa-bullhorn"></i>　编号</th>
                                <th style="text-align: center;" class="hidden-phone"><i class="fa fa-question-circle"></i>　名称</th>
                                <th style="text-align: center;"><i class=" fa fa-edit"></i>　操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($classifies as $classify)
                                <tr>
                                    <td><a href="basic_table.html#">{{$classify->id}}</a></td>
                                    <td class="hidden-phone">{{$classify->title}}</td>
                                    <td>
                                        <a href="/admin/classify_edit/{{$classify->id}}"><button class="btn btn-primary btn-xs" title="编辑"><i class="fa fa-pencil"></i></button></a>
                                        <a href="/admin/classify_delete/{{$classify->id}}"><button class="btn btn-danger btn-xs" title="删除"><i class="fa fa-trash-o"></i></button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> 添加分类</h4>
                        <form class="form-horizontal style-form" method="post" action="/admin/classify_add">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">点击添加该分类</button>
                        </form>
                    </div>
                </div><!-- col-lg-12-->
            </div>
        </section>
    </section>
@endsection
