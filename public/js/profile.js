$(document).on('click', '.delete', function(e){

  if (confirm("Delete this article?"))
  {

  }
  else
  {
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
  }

});