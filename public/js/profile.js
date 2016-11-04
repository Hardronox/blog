$(document).on('click', '#delete', function(e){

  if (confirm("Delete this item?"))
  {

  }
  else
  {
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
  }

});