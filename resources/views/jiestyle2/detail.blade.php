@extends("jiestyle2.basic")

@section("main")
    <article class="col-md-8 col-md-offset-2 view clearfix">
        <h1 class="view-title">{{$article['title']}}</h1>
        <div class="view-meta">
            <span>作者: {{$article['author']}}</span>
            <span>分类:
                @foreach($article['columns'] as $column)<a href="{{url('column/' . urlencode($column['alias']))}}" rel="category tag">{{$column['column_name']}}</a> @endforeach
            </span>
            <span>发布时间: {{mb_substr($article['write_time'], 0, 10)}}</span>
            <span>阅读: {{getBlogPv($article['id'], $article['pv'])}}</span>
        </div>
        <div class="view-content">@foreach($article['contents'] as $content){!! $content['content'] !!}@endforeach</div>
        <section class="view-tag">
            <div class="pull-left">
                @if(count($article['tags']) > 0)
                <i class="fa fa-tags"></i>
                @foreach($article['tags'] as $tag)<a href="{{url('tag/' . urlencode($tag['tag']))}}" rel="tag">{{$tag['tag']}}</a> @endforeach
                @endif
            </div>
        </section>

        {{-- TODO 打赏功能
        <section class="support-author">
            <p>如果觉得我的文章对您有用，请随意打赏。您的支持将鼓励我继续创作！</p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-cny" aria-hidden="true"></i> 打赏支持</button>
        </section>
         --}}

        {{-- TODO 评论功能
        <section id="comments">
            <div class="comment-head clearfix">
                <div class="pull-left">3条评论</div>
                <div class="pull-right"><a href="#respond"><i class="fa fa-pencil"></i> 添加新评论</a></div>
            </div>
            <ul>
                <li id="comment-li-29060" class="comment_li">
                    <div id="comment-29060">
                        <div class="comment_top clearfix">
                            <div class="comment_avatar"><img alt='' src='http://cn.gravatar.com/avatar/c3f95950f9191b2da501cbf5e89ae598?s=40&#038;d=wavatar&#038;r=g' srcset='http://cn.gravatar.com/avatar/c3f95950f9191b2da501cbf5e89ae598?s=80&amp;d=wavatar&amp;r=g 2x' class='avatar avatar-40 photo' height='40' width='40' /></div>
                            <div class="pull-left">
                                <p class="comment_author"><a href='http://tangjie.me/go.php?url=http://ss.com' rel='nofollow' target='_blank'>hahah</a></p>
                                <p class="comment_time">2017年4月8日 20:59</p>
                            </div>
                            <div class="pull-right"><a rel='nofollow' class='comment-reply-link' href='http://tangjie.me/blog/197.html?replytocom=29060#respond' onclick='return addComment.moveForm( "comment-29060", "29060", "respond", "197" )' aria-label='回复给hahah'>回复TA</a> </div>
                        </div>
                        <div class="comment_text"><p>测试</p>
                        </div>
                    </div>
                </li><!-- #comment-## -->
                <li id="comment-li-26536" class="comment_li">
                    <div id="comment-26536">
                        <div class="comment_top clearfix">
                            <div class="comment_avatar"><img alt='' src='http://cn.gravatar.com/avatar/5b4436db50fb1f3d0b4882845aa3f0f8?s=40&#038;d=wavatar&#038;r=g' srcset='http://cn.gravatar.com/avatar/5b4436db50fb1f3d0b4882845aa3f0f8?s=80&amp;d=wavatar&amp;r=g 2x' class='avatar avatar-40 photo' height='40' width='40' /></div>
                            <div class="pull-left">
                                <p class="comment_author"><a href='http://tangjie.me/go.php?url=http://qyhcsq.cn' rel='nofollow' target='_blank'>远航之帆</a></p>
                                <p class="comment_time">2017年1月11日 20:20</p>
                            </div>
                            <div class="pull-right"><a rel='nofollow' class='comment-reply-link' href='http://tangjie.me/blog/197.html?replytocom=26536#respond' onclick='return addComment.moveForm( "comment-26536", "26536", "respond", "197" )' aria-label='回复给远航之帆'>回复TA</a> </div>
                        </div>
                        <div class="comment_text"><p>都出书了，厉害，最先看到你的是在人人都是产品经理里面</p>
                            <p>【群英荟萃社区-产品狗（http://qyhcsq.cn/portal.php?mod=list&amp;catid=1）】高学历人才的网上家园</p>
                        </div>
                    </div>
                </li><!-- #comment-## -->
                <li id="comment-li-25791" class="comment_li">
                    <div id="comment-25791">
                        <div class="comment_top clearfix">
                            <div class="comment_avatar"><img alt='' src='http://cn.gravatar.com/avatar/83366ca026c40d977c971fd3956257b9?s=40&#038;d=wavatar&#038;r=g' srcset='http://cn.gravatar.com/avatar/83366ca026c40d977c971fd3956257b9?s=80&amp;d=wavatar&amp;r=g 2x' class='avatar avatar-40 photo' height='40' width='40' /></div>
                            <div class="pull-left">
                                <p class="comment_author">rajesh</p>
                                <p class="comment_time">2016年12月15日 10:51</p>
                            </div>
                            <div class="pull-right"><a rel='nofollow' class='comment-reply-link' href='http://tangjie.me/blog/197.html?replytocom=25791#respond' onclick='return addComment.moveForm( "comment-25791", "25791", "respond", "197" )' aria-label='回复给rajesh'>回复TA</a> </div>
                        </div>
                        <div class="comment_text"><p>坐等多看电子版推出后购买</p>
                        </div>
                    </div>
                </li><!-- #comment-## -->
            </ul>
            <div id="respond" class="comment-respond">
                <h4 id="reply-title" class="comment-reply-title">发表评论 <small><a rel="nofollow" id="cancel-comment-reply-link" href="/blog/197.html#respond" style="display:none;">取消回复</a></small></h4>			<form action="http://tangjie.me/wp-comments-post.php" method="post" id="commentform" class="comment-form">
                    <p class="comment-notes"><span id="email-notes">电子邮件地址不会被公开。</span> 必填项已用<span class="required">*</span>标注</p><div class="comment form-group has-feedback"><textarea class="form-control" id="comment" placeholder=" " name="comment" rows="5" aria-required="true" required  onkeydown="if(event.ctrlKey){if(event.keyCode==13){document.getElementById('submit').click();return false}};"></textarea></div><div class="comment-form-author form-group has-feedback"><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div><input class="form-control" placeholder="昵称" id="author" name="author" type="text" value="" " size="30" /><span class="form-control-feedback required">*</span></div></div>
                    <div class="comment-form-email form-group has-feedback"><div class="input-group"><div class="input-group-addon"><i class="fa fa-envelope-o"></i></div><input class="form-control" placeholder="邮箱" id="email" name="email" type="text" value="" " size="30" /><span class="form-control-feedback required">*</span></div></div>
                    <div class="comment-form-url form-group has-feedback"><div class="input-group"><div class="input-group-addon"><i class="fa fa-link"></i></div><input class="form-control" placeholder="网站" id="url" name="url" type="text" value="" " size="30" /></div></div>
                    <p class="form-submit"><input name="submit" type="submit" id="submit" class="btn btn-primary" value="发表评论" /> <input type='hidden' name='comment_post_ID' value='197' id='comment_post_ID' />
                        <input type='hidden' name='comment_parent' id='comment_parent' value='0' />
                    </p><p style="display: none;"><input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce" value="ea8f8a3e93" /></p><p style="display: none;"><input type="hidden" id="ak_js" name="ak_js" value="2"/></p>			</form>
            </div><!-- #respond -->
        </section>
        --}}
    </article>
    <section class="col-md-8 col-md-offset-2 clearfix">
        {{-- TODO 更多阅读
        <div class="read">
            <div class="read-head"> <i class="fa fa-book"></i> 更多阅读 </div>
            <div class="read-list row">
                <div class="col-md-6">
                    <ul>
                        <li><a href="http://tangjie.me/blog/211.html" target="_blank" >三套极简风格的WordPress主题模板</a></li>
                        <li><a href="http://tangjie.me/blog/213.html" target="_blank" >产品结构图和信息结构图的区别</a></li>
                        <li><a href="http://tangjie.me/blog/212.html" target="_blank" >小众需求也有春天</a></li>          </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li><a href="http://tangjie.me/blog/82.html" title="产品需求分析(中) – 需求分析和判断">产品需求分析(中) – 需求分析和判断</a></li>
                        <li><a href="http://tangjie.me/blog/69.html" title="浅谈：大数据时代如何智能购物">浅谈：大数据时代如何智能购物</a></li>
                        <li><a href="http://tangjie.me/blog/45.html" title="写写“产品经理岗位职责”">写写“产品经理岗位职责”</a></li>
                        <li><a href="http://tangjie.me/blog/46.html" title="如何提高工作效率？一些思考！">如何提高工作效率？一些思考！</a></li>
                        <li><a href="http://tangjie.me/blog/169.html" title="产品经理的两个职业瓶颈">产品经理的两个职业瓶颈</a></li>
                        <li><a href="http://tangjie.me/blog/172.html" title="产品经理应该有一个副产品">产品经理应该有一个副产品</a></li>
                        <li><a href="http://tangjie.me/blog/16.html" title="基于时间和LBS的母婴类产品社会化点评">基于时间和LBS的母婴类产品社会化点评</a></li>
                        <li><a href="http://tangjie.me/blog/119.html" title="假期了，把花旦交出来！">假期了，把花旦交出来！</a></li>
                        <li><a href="http://tangjie.me/blog/47.html" title="产品设计原则 之 体验设计(移动互联网产品设计)">产品设计原则 之 体验设计(移动互联网产品设计)</a></li>
                        <li><a href="http://tangjie.me/blog/39.html" title="最近的一些思考">最近的一些思考</a></li>
                    </ul>
                </div>
            </div>
        </div>
         --}}

        <div class="read">
            @if(count(getBlogAllTag()) > 0)
            <div class="read-head"> <i class="fa fa-tags"></i> 标签云 </div>
            <div class="read-list">
                @foreach(getBlogAllTag() as $tag)
                    <a href="{{url('tag/' . urlencode($tag['tag']))}}" class="tag-link-33 tag-link-position-1" title="{{$tag['tag']}}" style="color:{{randColor()}};font-size: {{rand(120000, 180000) / 10000}}pt;">{{$tag['tag']}}</a>
                @endforeach
            </div>
            @endif
        </div>
    </section>

@endsection

@section("afterEnd")<script src="{{url('/stat/pv', $article['id'])}}"></script>@endsection