(function($){$('.menu-toggle').click(function(e){$('.main-navigation').slideToggle(500);});})(jQuery);(function($){var $nav=$('.site-navigation');$(window).scroll(function(){if($(window).scrollTop()>0){if($(document).width()>992){$nav.addClass('sticky-navigation');}$('#top').show();}else{if($(document).width()>992){$nav.removeClass('sticky-navigation');}$('#top').hide();}});})(jQuery);