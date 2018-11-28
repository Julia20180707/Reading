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
                    <li><a href="#">散文</a></li>
                    <li><a href="#">小说</a></li>
                    <li><a href="#">恐怖</a></li>
                    <li><a href="#">悬疑</a></li>
                    <li><a href="#">伦理</a></li>
                    <li><a href="#">生活</a></li>
                    <li><a href="#">文艺</a></li>
                    <li><a href="#">儿童</a></li>
                    <li><a href="#">管理</a></li>
                    <li><a href="#">教育</a></li>
                </nav>
            </aside>
            <div class="col-xs-10 col-xs-offset-2 right_wrap">
                <div class="wrap">
                    <div class=" img_wrap">
                        <img src="/home/images/banner1.png"/>

                    </div>
                    <div class=" search_wrap">
                        <div class="col-xs-4">热门<input type="checkbox"></input></div>
                        <div class="col-xs-4">推荐<input type="checkbox"></input></div>
                        <div class="col-xs-4">排行<input type="checkbox"></input></div>
                    </div>
                </div>
                <div class="wrap_stance"></div>
                <div class=" book_list">
                    <div class="book_info">
                        <div class="row">
                            <a href="/book_detail/1">
                                <div class="col-xs-4">
                                    <img src="/home/images/1_10.png"/>
                                </div>
                                <div class="col-xs-8 info">
                                    <h3>杀死一只知更鸟</h3>
                                    <h4>作者：【美】哈珀·李</h4>
                                    <span>2456875人在读</span>
                                    <p>这个世界的规律有时候是不可思议的。被伤害的人被责备，加害者却高枕无忧。</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="book_info">
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="/home/images/1_10.png"/>
                            </div>
                            <div class="col-xs-8 info">
                                <h3>杀死一只知更鸟</h3>
                                <h4>作者：【美】哈珀·李</h4>
                                <span>2456875人在读</span>
                                <p>这个世界的规律有时候是不可思议的。被伤害的人被责备，加害者却高枕无忧。</p>
                            </div>
                        </div>
                    </div>
                    <div class="book_info">
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="/home/images/1_10.png"/>
                            </div>
                            <div class="col-xs-8 info">
                                <h3>杀死一只知更鸟</h3>
                                <h4>作者：【美】哈珀·李</h4>
                                <span>2456875人在读</span>
                                <p>这个世界的规律有时候是不可思议的。被伤害的人被责备，加害者却高枕无忧。</p>
                            </div>
                        </div>
                    </div>
                    <div class="book_info">
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="/home/images/1_10.png"/>
                            </div>
                            <div class="col-xs-8 info">
                                <h3>杀死一只知更鸟</h3>
                                <h4>作者：【美】哈珀·李</h4>
                                <span>2456875人在读</span>
                                <p>这个世界的规律有时候是不可思议的。被伤害的人被责备，加害者却高枕无忧。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection