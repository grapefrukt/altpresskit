$(document).ready(function(){

	// populates menu using all h2 tags present on page
	var menu = '<ul>';
	$('h2').each(function() {
		menu += '<li><a href="#' + $(this).parent().attr('id') + '">' + $(this).text() + '</a></li>'
	});
	menu += '</ul>';
	$('#menu').html(menu);


	// makes menu stick to top of screen
	var dummymenu = $('#dummy-menu');
	var menu = $('#menu');

	var updateMenu = function() {
		var menutop = dummymenu.offset().top - 10;
		var scrolltop = $(window).scrollTop();
		if(scrolltop < menutop && menu.css('position') == 'fixed' ){
			menu.css('top', menutop - Math.max(scrolltop, 0));
		} else {
			menu.css('top', 0);
		}
	};

	$.event.add(window, 'scroll', updateMenu);
	$.event.add(window, 'resize', updateMenu);
	updateMenu();


	// inline form code from: http://zurb.com/playground/inline-form-labels
	$('label + input[type="text"]').each(function (type) {

		$(this).focus(function () {
			$(this).prev('label').addClass('focus');
		});
		 
		$(this).keypress(function () {
			$(this).prev('label').addClass('has-text').removeClass('focus');
		});
		 
		$(this).blur(function () {
			if($(this).val() == '') {
				$(this).prev('label').removeClass('has-text').removeClass('focus');
			}
		});
	});
});