$(document).ready(function () {
	$('.stripe-button-el').css('display', 'none');
});

$(document).on('click', '.subscribe_button', function () {

	$(".content").fadeIn(500);

	$('html, body').animate({
		'scrollTop': $('.become_subscriber').offset().top
	}, 1000);
});


$(document).on('click', '.payment_method', function () {

	var type = $(this).data('type');
	$('.payment_method').css('border', '2px solid white');
	$(this).css({'border': '2px solid orange', 'border-radius': '5px'});

	$('.payment_button').prop("disabled", false);


	$('.payment_button').parents('form:first').attr('action', '/payment/' + type);

});


$(document).on('click', '.payment_button', function () {

	var action = $('.payment_button').parents('form:first').attr('action');

	if (action == '/payment') {
		return false;
	}
	else if (action == '/payment/paypal') {
		$('form script').remove();
		$('body iframe').remove();
		$('.payment_button').parents('form:first').submit();
	}

});