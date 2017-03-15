define(['jquery', 'ueditor', 'zeroclipboard', 'datetimepicker', 'datetimepicker-lang', 'ueditor-lang', 'bootstrap'], function($, UE, zcl) {
    // 添加标签
    function addTag(tag) {
        if (!tag) {
            return;
        }

        var exists = false;
        $('.tag', '#tagBox').each(function() {
            if ($(this).data('tag') == tag) {
                exists = true;
                return false;
            }
        });

        if (!exists) {
            var $tag = $('<div class="tag pull-left" style="margin-right: 5px;">\
                    <span class="glyphicon glyphicon-remove-sign"></span>\
                    <a href="javascript:void(0);"></a>\
                    <input type="hidden" name="tag[]" role="tag">\
                    </div>');

            $tag.attr('data-tag', tag).data('tag', tag);
            $tag.find('a').html(tag);
            $tag.find('[role=tag]').val(tag);
            $('#tagBox').append($tag);
            $tag.find('.glyphicon-remove-sign').click(function() {
                $tag.remove();
            });
        }
    }

    var obj = {
        init: function() {
            window.ZeroClipboard = zcl;
            window.uploadToken = $('#uploadToken').html();
            // 初始化编辑器
            var ue = UE.getEditor('editor');

            // 日期控件
            $('.datetimepicker').datetimepicker({
                format: 'yyyy-mm-dd',
                language: 'zh-CN',
                minView: 2,
                maxView: 'year',
                autoclose: true,
                todayBtn: true,
                todayHighlight: true,
                weekStart: 0
            });

            // 添加标签按钮
            $('#btnAddTag').click(function() {
                var tags = $('#iptTags').val().split(',');
                $('#iptTags').val('');
                for (var i in tags) {
                    addTag(tags[i]);
                }
            });

            // 显示隐藏常用标签
            $('#btnAllTagBox').click(function() {
                if ($('#allTagBox').hasClass('hide')) {
                    $('#allTagBox').removeClass('hide');
                } else {
                    $('#allTagBox').addClass('hide');
                }
            });

            // 选择常用标签
            $('.tag', '#allTagBox').click(function() {
                addTag($(this).html());
            });

            // 预览
            $('#btnPreview').click(function() {
                var $form = $('<form class="hide" action="/article-manage/article/preview" target="_blank" method="post">\
                    <input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">\
                </form>');

                $.each($('#dataForm').serializeArray(), function(i, obj) {
                    var $input = $('<input type="text">');
                    $input.val(obj.value);
                    $input.attr('name', obj.name);
                    $form.append($input);
                });

                $('body').append($form);
                $form.submit();
                $form.remove();
            });

            // 封面选择
            $('input[name=cover_type]').click(function() {
                if ($(this).val() == 1) {
                    $('#cover-box').addClass('hide');
                } else {
                    $('#cover-box').removeClass('hide');
                }
            });

            // 从正文中选择
            $('#btn-cover-choose').click(function() {
                var $modal = $('<div class="modal fade" tabindex="-1" role="dialog">\
                                      <div class="modal-dialog" role="document">\
                                        <div class="modal-content">\
                                          <div class="modal-header">\
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                                            <h4 class="modal-title">请选择图片</h4>\
                                          </div>\
                                          <div class="modal-body">\
                                          </div>\
                                          <div class="modal-footer">\
                                            <button type="button" class="btn btn-primary">确定</button>\
                                          </div>\
                                        </div>\
                                      </div>\
                                    </div>');

                $(ue.getContent()).find('img').each(function() {

                    console.log($(this).attr('src'));
                });
            });

            // 重新上传
            $('#btn-cover-upload').click(function() {
                console.log('重新上传');
            });
        },
        addTag: addTag
   };

    obj.init();

    return obj;
});