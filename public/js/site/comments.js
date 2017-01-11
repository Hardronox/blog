$(function(){

  var templates = _.template($('#pageContent').html());
  var text=$('#comment_text');
  var url = $(location).attr('href').split("/");

  $(document).ready(function()
  {
    $.post('/comments',
      {
        article_id: url[4]
      },
      function (response) {
        $.each(response, function(key, comments){

          response_partial(comments);

        }, 'json');
      });
  });

  function saveComment()
  {

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
    var likes =server_answer.likes.length;

    $('#blog_view_comment_content').append(templates({comments:server_answer,likes: likes}));

  }

  function answer(elem) //онклик на кнопку: Ответить
  {
    var name=$(elem).data('name');
    $('html, body').animate({
      scrollTop: text.offset().top
    }, 800);
    text.val(name+", ");
    text.attr('data-name',name+", ");
  }

  text.on('blur', function(e) {
    if (text.val() == text.attr('data-name'))
    {
      $('#comment_text').val('');
    }
  });
});
