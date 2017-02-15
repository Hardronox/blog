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