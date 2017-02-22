// when we try to delete smth in profile
$(document).on('click', '.delete', function (e) {

	let attr = $(this).attr('href');
	let text_type = attr.substr((attr.indexOf('/', 10) + 1), attr.indexOf('/', 24) - (attr.indexOf('/', 10) + 1));

	if (!confirm("Delete this " + text_type + "?")) {
		e.preventDefault();
		e.stopImmediatePropagation();
		return false;
	}
});