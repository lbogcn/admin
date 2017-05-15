@extends("jiestyle2.basic")

@section("main")
    <div class="row box">
        <div class="col-md-8">
            @foreach(getBlogTopArticles($columnId) as $article)
                <h2 class="uptop">
                    <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                    <a href="{{url('blog/' . $article['id'])}}">{{$article['title']}}</a>
                </h2>
            @endforeach

            @foreach($articles = getBlogColumnArticles($columnId) as $article)
                <article class="article-list-1 clearfix">
                    <header class="clearfix">
                        <h1 class="post-title"><a href="{{url('blog/' . $article['id'])}}">{{$article['title']}}</a></h1>
                        <div class="post-meta">
                            <span class="meta-span"><i class="fa fa-calendar"></i> {{mb_substr($article['write_time'], 0, 10)}}</span>
                            <span class="meta-span"><i class="fa fa-folder-open-o"></i>
                                @foreach($article['columns'] as $column)
                                    <a href="{{url('column/' . urlencode($column['alias']))}}" rel="category tag">{{$column['column_name']}}</a>
                                @endforeach
                                </span>
                            {{-- TODO 评论暂不开放
                            <span class="meta-span"><i class="fa fa-commenting-o"></i> <a href="http://tangjie.me/blog/213.html#comments">9条评论</a></span>
                            --}}
                            @if(count($article['tags']) > 0)
                                <span class="meta-span hidden-xs">
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    @foreach($article['tags'] as $tag)<a href="{{url('tag/' . urlencode($tag['tag']))}}" rel="tag">{{$tag['tag']}}</a> @endforeach
                                </span>
                            @endif
                        </div>
                    </header>
                    <div class="post-content clearfix">
                        <p>{{$article['excerpt']}}</p>
                    </div>
                </article>
            @endforeach

            <nav class="pull-right">
                {!! $articles->render() !!}
            </nav>
        </div>
        <div class="col-md-4 hidden-xs hidden-sm">

            {{-- TODO 搜索暂不开放
            <aside class="widget clearfix">
                <form id="searchform" action="http://tangjie.me">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="搜索…" value="" name="s">
                        <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                    </div>
                </form>
            </aside>
             --}}

            {{-- TODO 栏目区分主分类、子分类，并统计分类下文章个数
            <aside class="widget clearfix">
                <h4 class="widget-title">文章分类</h4>
                <div class="widget-cat">
                    <ul>
                        <li class="cat-item cat-item-20"><a href="http://tangjie.me/at/fenxiang" title="若有好东西，岂能我独享。">一些分享</a> (26)
                        </li>
                        <li class="cat-item cat-item-21"><a href="http://tangjie.me/at/tiyan" title="体验各产品，总结些体会。">产品体验</a> (7)
                        </li>
                        <li class="cat-item cat-item-22"><a href="http://tangjie.me/at/sheji" title="产品的心得，设计的技巧。">产品设计</a> (29)
                        </li>
                        <li class="cat-item cat-item-11"><a href="http://tangjie.me/at/zakan" title="工作之外事，也可调侃谈。">天下杂侃</a> (35)
                        </li>
                        <li class="cat-item cat-item-23"><a href="http://tangjie.me/at/idea" title="思维的火花，有趣的想法。">奇思妙想</a> (9)
                        </li>
                        <li class="cat-item cat-item-1"><a href="http://tangjie.me/at/ganwu" title="产品的心得，工作的感悟">心得感悟</a> (10)
                        </li>
                        <li class="cat-item cat-item-234"><a href="http://tangjie.me/at/shu" title="产品经理书籍">杰出产品经理书 v1.0</a> (33)
                        </li>
                        <li class="cat-item cat-item-361"><a href="http://tangjie.me/at/shu-2" title="产品经理书籍">杰出产品经理书 v2.0</a> (9)
                        </li>
                        <li class="cat-item cat-item-12"><a href="http://tangjie.me/at/zhichang" title="职场也人生，学习更上进。">职场人生</a> (45)
                        </li>
                        <li class="cat-item cat-item-2"><a href="http://tangjie.me/at/yuedu" title="阅读笔记和读后感">阅读笔记</a> (7)
                        </li>
                    </ul>
                </div>
            </aside>
             --}}

            <aside class="widget clearfix">
                <h4 class="widget-title">热门文章</h4>
                <ul class="widget-hot">
                @foreach(getBlogHotArticles($columnId) as $article)
                    <li><a href="{{url('blog/' . $article['id'])}}">{{$article['title']}}</a></li>
                @endforeach
                </ul>
            </aside>

            <aside class="widget clearfix">
                <h4 class="widget-title">标签云</h4>
                <div class="widget-tags">
                    @foreach(getBlogAllTag() as $tag)
                        <a href="{{url('tag/' . urlencode($tag['tag']))}}" class="tag-link-33 tag-link-position-1" title="{{$tag['tag']}}" style="color:{{randColor()}};font-size: {{rand(120000, 180000) / 10000}}pt;">{{$tag['tag']}}</a>
                    @endforeach
                </div>
            </aside>
            <aside class="widget clearfix">
                <h4 class="widget-title">友情链接</h4>
                <ul class="widget-links">
                    @foreach(getBlogLinks() as $link)
                        <li><a href="{{$link['url']}}" title="{{$link['title']}}" target="_blank">{{$link['title']}}</a></li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </div>
@endsection