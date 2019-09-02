jQuery(document).ready(function ($) {
	var browserWidth = $(document).width();
	var wrapWidth = $('.owl-slide-widget').width();
	var margin = ((browserWidth - wrapWidth) / 2);
	$('.full-slide').css('margin-left', -margin).css('margin-right', -margin);

	$('#homeslide').owlCarousel({
		items: 1,
		dots: false,
		loop: true,
		autoplay: true,
		nav: true,
		navText: ['<i class="slide-prev"></i>', '<i class="slide-next"></i>'],
	});

	$("#video-lightbox").click(function () {
		$.fancybox({
			'padding': 0,
			'autoScale': false,
			'transitionIn': 'none',
			'transitionOut': 'none',
			'title': this.title,
			'width': 680,
			'height': 495,
			'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type': 'swf',
			'swf': {
				'wmode': 'transparent',
				'allowfullscreen': 'true'
			}
		});

		return false;
	});

	$('#matbangtab').owlCarousel({
		items: 1,
		dots: false,
		loop: true,
		autoplay: true,
		thumbs: true,
		thumbsPrerendered: true,
	});

	$("a[rel=tien-ichs]").fancybox();
	$("a[rel=thiet-ke-can-ho]").fancybox();
	$("a[rel=can-ho-mau]").fancybox();

	if ($(document).width() < 768) {
		$(".toogle-support").click(function () {
			$(".toogle-support-item").fadeToggle(500);
			$(".toogle-support .fa").toggleClass("fa-phone");
			$(".toogle-support .fa").toggleClass("fa-times");
		});
	}
});
