$(document).ready(function(){

	// populates menu using all h2 tags present on page
	var menu = '';
	$('h2').each(function() {
		menu += '<li><a href="#' + $(this).parent().attr('id') + '">' + $(this).text() + '</a></li>'
	});
	$('#menu ul').append(menu);


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

	// resizes videos/images to stay in widescreen aspect ratio
	var updateVideoSize = function(){
		$('.widescreen').each(function() {
			$(this).css('height', $(this).width() * .5625);
		});
	}

	$.event.add(window, 'resize', updateVideoSize);
	updateVideoSize();

	// inline form code from: http://zurb.com/playground/inline-form-labels
	$('label + input[type="text"]').each(function(type) {

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

	var validateForm = function(){
		$('#presscopy button').prop('disabled', $('#email').val() == '');
	}
	validateForm();

	$('#presscopy input[type="text"]').keyup(validateForm);
	$('#presscopy input[type="text"]').change(validateForm);

	$('#presscopy form').submit(function(event) {
		var data = $(this).serialize();
		var button = $('#presscopy button');

		$('#presscopy input[type="text"]').each(function(){
			$(this).animate({ opacity : .7 }, { duration : 1000 });
			$(this).prop("disabled", true);
		});

		button.prop('disabled', true);
		button.html('<i class="icon-spinner icon-spin icon-large"></i>');

		var postData = function(){
			$.post('', data, function(result){
				$('#presscopy .status').text('Completed!');
				$('#presscopy form')[0].reset();

				$('#presscopy input[type="text"]').each(function(){
					$(this).animate({ opacity : 1 }, { duration : 1000 });
					$(this).prop("disabled", false);
					$(this).blur();
				});


				if(result == 'OK') {
					button.html('<i class="icon-ok-circle"></i> Success!');
					button.toggleClass('success', true);
				} else {
					button.html('<i class="icon-warning-sign"></i> Failed!');
					button.toggleClass('fail', true);
					$('#presscopy form').after('<ul class="errors twelve columns alpha omega"><li>' + result + '</li></ul>')
				}
				
				setTimeout(function(){
					button.html('Request');
					button.toggleClass('success', false);
					button.toggleClass('fail', false);
					validateForm();
				}, 2000);

			});
		}

		setTimeout(postData, 1000);

		return false; // avoid to execute the actual submit of the form.
	});
});