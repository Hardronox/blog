var text = $('#comment_text');
var url = $(location).attr('href').split("/");
var done=false;
var slug =url[4];
//showing comments
if ($('#view-article').length){
	$(window).scroll(function() {

		if( ($(window).scrollTop() > $('#view-article').offset().top ) && done === false) {
			$.post('/comments',
				{
					slug
				},
				(response) => {
					$.each(response, (key, comments) => {


						response_partial(comments);

					}, 'json');
				});

			done =true;
		}
	});
}


//onclick on the answer button
$(document).on('click', '.answer_button', function() {

	let name = $(this).data('name');
	let text = $('#comment_text');

	$('html, body').animate({
		scrollTop: text.offset().top
	}, 600);

	text.val(name + ", ");
	text.attr('data-name', name + ", ");
});

// save comment
$(document).on('click', '.write-comment', () => {

	if (text.val() != 0) {
		$.post('/comment/save',
			{
				slug,
				text: text.val()
			},
			(response) => {
				response_partial(response);
			}, 'json');
	}
	else return false;
	$('#comment_text').val('');
	$('.write-comment').blur();

});


function response_partial(server_answer) {
	let templates = _.template($('#pageContent').html());
	let likes = server_answer.likes.length;

	$('#comment_block').append(templates({comments: server_answer, likes}));

	let src=$('.comment_image').attr('src').replace('public','/storage');
	$('.comment_image').attr('src',src);

}



