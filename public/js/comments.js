var id = location.search.slice(4);
var templates = _.template($('#pageContent').html());

$(document).ready(function()
{
  $.post('/comments',
    {
      id: id
    },
    function (response) {
      $.each(response, function(key, comments){

        response_partial(comments);

      }, 'json');
    });
});

function saveComment()
{
  var text=$('#comment_text');

  if (text.val() !=0)
  {
    $.post('/service/save-comment',
      {
        id: id,
        text: text.val()
      },
      function (response) {
        response_partial(response);

      }, 'json');
  }
  else return false;
  text.val('');
}

function response_partial(server_answer)
{
  //функция из moment js
  var date = moment.unix(server_answer.created_at).format("DD-MM-YYYY H:mm");
  var likes =server_answer.likes.length;

  $('#blog_view_comment_content').append(templates({comments:server_answer , date: date,likes: likes}));

}

function answer(elem) //онклик на кнопку: Ответить
{
  var name=$(elem).data('name');
  $('html, body').animate({
    scrollTop: $("#comment_text").offset().top
  }, 800);
  $("#comment_text").val(name+", ");
  $("#comment_text").attr('data-name',name+", ");
}

$('#comment_text').on('blur', function(e) {
  if ($('#comment_text').val() == $('#comment_text').attr('data-name'))
  {
    $('#comment_text').val('');
  }
});