$(document).on('click', '.make-premium', function() {

	let id = $(this).data('id');

	$.ajax({
		url: '/article/premium',
		type: 'get',
		data: {
			id: id
		},
		success: (response) => {
			$('#tr' + id).find('td.premium').html(response);

			Noty({
				text: 'Premium Status has been updated!'
			});

		}
	});
});