(function($) {
	$(function() {
		var $body = $('body'),
			$header = $('#header'),
			$nav = $('#nav'),
			$nav_a = $nav.find('a'),
			$wrapper = $('#wrapper');
		$('form').placeholder();
		skel.on('+medium -medium', function() {
			$.prioritize('.important\\28 medium\\29', skel.breakpoint('medium').active)
		});
		$('<div id="titleBar">' + '<a href="#header" class="toggle"></a>' + '<span class="title">' + $('#name').html() + '</span>' + '</div>').appendTo($body);
		$('#header').panel({
			delay: 500,
			hideOnClick: true,
			hideOnSwipe: true,
			resetScroll: true,
			resetForms: true,
			side: 'right',
			target: $body,
			visibleClass: 'header-visible'
		});

		if (skel.vars.os == 'wp' && skel.vars.osVersion < 10) {
		    $('#titleBar, #header, #main').css('transition', 'none');
        }

        $('#img-captcha').click(function() {
            var loading = '/images/loading.gif';
            var $self = $(this);

            if ($self.attr('src') == loading) {
                return;
            }

            var img = new Image();
            img.src = $self.attr('src').split('?')[0] + '?' + parseInt(Math.random() * 10000);

            $self.attr('src', loading);

            if (img.complete) {
                $self.attr('src', img.src);
            }
            img.onload = function() {
                $self.attr('src', img.src);
            };
        });
	});
})(jQuery);