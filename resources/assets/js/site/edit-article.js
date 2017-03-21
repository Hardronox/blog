$(document).on('submit', '#edit-article', function() {

	localStorage.setItem('article-edited:'+$('#title').val(), true);

});