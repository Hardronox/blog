$(document).on('click', '.delete', function(e){

  var attr=$(this).attr('href');
  var text_type=attr.substr(1,(attr.indexOf('/',2)-1));

  if (confirm("Delete this "+text_type+"?"))
  {

  }
  else
  {
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
  }
});