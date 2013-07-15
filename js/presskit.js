$(document).ready(function(){
	var menu = '<ul>';
	$('h2').each(function() {
		menu += '<li><a href="#' + $(this).parent().attr('id') + '">' + $(this).text() + '</a></li>'
	});
	menu += '</ul>';
	$('#menu').html(menu);
});