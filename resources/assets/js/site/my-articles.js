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
				//type: 'information',
				layout:'bottomRight',
				text: 'Status has been changed!',
				//theme: 'defaultTheme',
				timeout: 2000,
				template: '<div class="noty_message" ><span class="noty_text"></span><div class="noty_close"></div></div>',
				animation: {
					open: {height: 'toggle'},
					close: {height: 'toggle'},
					easing: 'swing',
					speed: 400 // opening & closing animation speed
				}
			});
			// tried to override classes of noty but these options were unwilling to change :\
			$(".noty_message").css("text-align","center");
			$("li").css("border","none");
		}
	});
});