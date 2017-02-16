$(document).on('click', '.a-hover', function() {

	//let id = $(this).data('id');


	let id = $(this).data('post');
	let type = $(this).data('type');

	$.ajax({
		url: '/likes',
		type: 'get',
		data: {
			id,
			type
		},
		dataType: 'json',
		success: (response) => {

			$(this).find('span#likes').html(response);

		}
	});
});