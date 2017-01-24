function like(elem) {

	var id = $(elem).data('post');
	var type = $(elem).data('type');

	$.ajax({
		url: '/likes',
		type: 'get',
		data: {
			id: id,
			type: type
		},
		dataType: 'json',
		success: function (response) {

			$(elem).find('span#likes').html(response);

		}
	});
}