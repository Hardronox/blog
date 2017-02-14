function changeStatus(elem) {

	let id = $(elem).data('id');

	$.ajax({
		url: '/article/status',
		type: 'get',
		data: {
			id: id
		},
		success: (response) => {
			$('#tr' + id).find('td.status').html(response);
		}
	});
}