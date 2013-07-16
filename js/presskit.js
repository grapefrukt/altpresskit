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

	$.event.add(window, "scroll", updateMenu);
	$.event.add(window, "resize", updateMenu);
	updateMenu();
});