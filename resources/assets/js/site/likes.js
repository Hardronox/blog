function like(elem) {

	let id = $(elem).data('post');
	let type = $(elem).data('type');

	$.ajax({
		url: '/likes',
		type: 'get',
		data: {
			id,
			type
		},
		dataType: 'json',
		success: (response) => {

			$(elem).find('span#likes').html(response);

		}
	});
}