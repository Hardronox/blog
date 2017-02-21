$(document).on('click', '.change-status', function() {

	let id = $(this).data('id');

	$.ajax({
		url: '/article/status',
		type: 'get',
		data: {
			id: id
		},
		success: (response) => {
			$('#tr' + id).find('td.status').html(response);

			Noty({
				text: 'Status has been updated!'
			});

		}
	});
});