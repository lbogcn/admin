@extends("jiestyle2.basic")

@section("main")
    <div class="row box">
        <div class="col-md-8">
            <h3 class="uptop"><i class="fa fa-tags" aria-hidden="true"></i> 标签：{{$tag}}</h3>
            @foreach($articles = getBlogTagArticles($tag) as $article)
                <article class="article-list-2 clearfix">
                    <div class="post-time"><i class="fa fa-calendar"></i> {{mb_substr($article['write_time'], 0, 10)}}</div>
                    <h1 class="post-title"><a href="http://tangjie.me/blog/134.html">{{$article['title']}}</a></h1>
                    <div class="post-meta">
                        @if(count($article['columns']) > 0)
                        <span class="meta-span"><i class="fa fa-folder-open-o"></i>
                            @foreach($article['columns'] as $column)
                                <a href="{{url('column/' . urlencode($column['alias']))}}" rel="category tag">{{$column['column_name']}}</a>
                            @endforeach
                        </span>
                        @endif

                        {{-- TODO 评论
                        <span class="meta-span"><i class="fa fa-commenting-o"></i> <a href="http://tangjie.me/blog/134.html#comments">2条评论</a></span>
                        --}}
                        @if(count($article['tags']) > 0)
                        <span class="meta-span hidden-xs"><i class="fa fa-tags" aria-hidden="true"></i>
                            @foreach($article['tags'] as $tag)<a href="{{url('tag/' . urlencode($tag['tag']))}}" rel="tag">{{$tag['tag']}}</a> @endforeach
                        </span>
                        @endif
                    </div>
                </article>
            @endforeach
            {!! $articles->render() !!}
        </div>
        <div class="col-md-4 hidden-xs hidden-sm">
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
        </div>
    </div>
@endsection