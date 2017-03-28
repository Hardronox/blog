$(document).ready( () => {

	if(	localStorage.getItem('article-created') && window.location.pathname==='/'){

		Noty({
			text: 'Article was created!'
		});
		localStorage.removeItem('article-created');
	}

});

function showPagination() {
	$('#pagi').css('display', 'block');
}
setTimeout(showPagination, 2500);

$( () => {
	$('[data-toggle="tooltip"]').tooltip()
});


$( () => {
	$('select[name=category]').addClass('form-control')
});


$.noty.defaults.layout = 'bottomRight';
$.noty.defaults.timeout = 2000;
$.noty.defaults.animation= {
								open: {height: 'toggle'},
								close: {height: 'toggle'},
								easing: 'swing',
									speed: 400 // opening & closing animation speed
							};

$.noty.defaults.template = '<div class="noty_message" ><span class="noty_text"></span><div class="noty_close"></div></div>';

$.noty.defaults.callback= {
	onShow: function () {

		// tried to override classes of noty but these options were unwilling to change :\
		$(".noty_message").css("text-align","center");
		$("li").css("border","none");
	}
};


