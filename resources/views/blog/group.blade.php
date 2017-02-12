@extends('blog.basic')

@section('container')
    <div id="index" class="bs">
        <h1 class="h4">{{$pageName}}</h1>
        <div id="list">
            <p class="date"><strong>{{get_option('blog_name')}}</strong>目前共有文章： {{$total}}篇 </p>
            <div class="car-container car-collapse">
                <a href="#" class="car-toggler">折叠所有月份</a>

                <ul id="car-list">
                    @foreach($groups as $key => $group)
                        <li>
                            <div class="uk-sticky-placeholder" style="height: 27px; margin: 0px;">
                                <span class="car-yearmonth" data-uk-sticky="{boundary: true}" style="margin: 0;">+ {{$key}} <span title="文章数量">(共{{count($group)}}篇文章)</span></span>
                            </div>

                            <ul class="car-monthlisting" style="display: block;">
                                @foreach($group as $detail)
                                    <li>
                                        {{intval(mb_substr($detail['created_at'], 8, 2))}}日:
                                        <a target="_blank" href="{{url('blog/' . $detail['id'])}}">{{$detail['title']}}</a>
                                        {{--<span title="评论数量">(0条评论)</span>--}}
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.car-collapse').find('.car-monthlisting').hide();
            $('.car-collapse').find('.car-monthlisting:first').show();
            $('.car-collapse').find('.car-yearmonth').click(function () {
                $(this).parent('div').next('ul').slideToggle('fast');

            });
            $('.car-collapse').find('.car-toggler').click(function () {
                if ('展开所有月份' == $(this).text()) {
                    $(this).parent('.car-container').find('.car-monthlisting').show();
                    $(this).text('折叠所有月份');
                }
                else {
                    $(this).parent('.car-container').find('.car-monthlisting').hide();
                    $(this).text('展开所有月份');
                }
                return false;
            });
        });
    </script>
@endsection