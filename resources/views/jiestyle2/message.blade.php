<?php $pageName = $column->column_name; ?>
@extends("jiestyle2.basic")

@section("head-extend")
    @if($errors->any())<script>alert('{!! $errors->first() !!}');</script>@endif
@endsection

@section("main")
    <article class="col-md-8 col-md-offset-2 view clearfix">
        <h1 class="view-title" style="border-bottom:1px dashed #5bc0eb;padding-bottom:10px;margin-bottom:30px;">{{$pageName}}</h1>
        <div class="view-content">
            <form action="{{url('message')}}" class="form-horizontal" method="post">
                <p class="comment-notes"><span id="email-notes">电子邮件地址不会被公开。</span></p>

                <div class="form-group">
                    <div class="col-xs-12">
                        <textarea class="form-control" name="content" rows="5" maxlength="200">{!! old('content') !!}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" name="nickname" placeholder="昵称" maxlength="16" value="{{old('nickname')}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" name="username" placeholder="邮箱" maxlength="32" value="{{old('username')}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" class="form-control" name="captcha" placeholder="验证码">
                    </div>
                    <div class="col-xs-12 col-sm-6 pull-left">
                        <a href="javascript:void(0);" title="点击刷新"><img src="{{captcha_src()}}" alt="验证码" class="img-responsive" id="img-captcha"></a>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary">发表</button>
                    </div>
                </div>
            </form>
        </div>

        <section id="comments">

            {{--<div class="comment-head clearfix">--}}
                {{--<div class="pull-left">6条评论</div>--}}
                {{--<div class="pull-right"><a href="#respond"><i class="fa fa-pencil"></i> 添加新评论</a></div>--}}
            {{--</div>--}}
            <ul>
                @foreach($paginate = \App\Models\Message::with('user')->orderBy('id', 'desc')->paginate() as $message)
                    <li id="comment-li-{{$message->id}}" class="comment_li">
                        <div id="comment-{{$message->id}}">
                            <div class="comment_top clearfix">
                                <div class="comment_avatar">
                                    {{--<img alt="" src='http://cn.gravatar.com/avatar/a28fc5a5e0dbc0076f73eddbad2e2406?s=40&#038;d=wavatar&#038;r=g' srcset='http://cn.gravatar.com/avatar/a28fc5a5e0dbc0076f73eddbad2e2406?s=80&amp;d=wavatar&amp;r=g 2x' class='avatar avatar-40 photo' height='40' width='40' />--}}
                                </div>
                                <div class="pull-left">
                                    <p class="comment_author">{{$message->user->nickname}}</p>
                                    <p class="comment_time">{{$message->created_at}}</p>
                                </div>
                                <div class="pull-right">
                                    {{--<a rel='nofollow' class='comment-reply-link' href='http://tangjie.me/blog/212.html?replytocom=28388#respond' onclick='return addComment.moveForm( "comment-28388", "28388", "respond", "212" )' aria-label='回复给nick'>回复TA</a>--}}
                                </div>
                            </div>
                            <div class="comment_text"><p>{!! str_replace("\n", '<br>', $message->content) !!}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="pull-right">
                {!! $paginate->render() !!}
            </div>
        </section>
    </article>
@endsection