let text = $('#comment_text');
let url = $(location).attr('href').split("/");

$(document).ready( () => {
	$.post('/comments',
		{
			article_id: url[4]
		},
		(response) => {
			$.each(response, (key, comments) => {

				response_partial(comments);

			}, 'json');
		});
});

//onclick on the answer button
function answer(elem)
{
	let name = $(elem).data('name');
	let text = $('#comment_text');

	$('html, body').animate({
		scrollTop: text.offset().top
	}, 600);

	text.val(name + ", ");
	text.attr('data-name', name + ", ");
}

function saveComment() {
	let text = $('#comment_text').val();

	if (text != 0) {
		$.post('/comment/save',
			{
				id: url[4],
				text
			},
			(response) => {
				response_partial(response);
			}, 'json');
	}
	else return false;
	$('#comment_text').val('');
}

function response_partial(server_answer) {
	let templates = _.template($('#pageContent').html());
	let likes = server_answer.likes.length;

	$('#comment_block').append(templates({comments: server_answer, likes}));
}