function changeStatus(elem) {

	var id = $(elem).data('id');

	$.ajax({
		url: '/article/status',
		type: 'get',
		data: {
			id: id
		},
		success: function (response) {
			$('#tr' + id).find('td.status').html(response);
		}
	});
}