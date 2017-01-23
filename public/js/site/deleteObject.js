$(document).on('click', '.delete', function(e){

  var attr=$(this).attr('href');
  var text_type=attr.substr( (attr.indexOf('/',10)+1), attr.indexOf('/',24)-(attr.indexOf('/',10)+1) );

  if (!confirm("Delete this "+text_type+"?"))
  {
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
  }

});