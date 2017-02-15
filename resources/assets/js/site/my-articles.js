//function changeStatus(elem) {
//
//	let id = $(elem).data('id');
//
//	$.ajax({
//		url: '/article/status',
//		type: 'get',
//		data: {
//			id: id
//		},
//		success: (response) => {
//			$('#tr' + id).find('td.status').html(response);
//
//			Noty({
//				type: 'success',
//				layout:'bottomRight',
//				text: 'Status has been changed!'
//			});
//		}
//	});
//}

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
				type: 'information',
				layout:'bottomRight',
				text: 'Status has been changed!',
				theme: 'defaultTheme', // or relax
				timeout: 2000,
				animation: {
					open: {height: 'toggle'},
					close: {height: 'toggle'},
					easing: 'swing',
					speed: 400 // opening & closing animation speed
				}
			});
		}
	});
});