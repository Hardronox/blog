$(document).on('click', '.subscribe_button', function(e){

  $(".kek").fadeIn(500);

  $('html, body').animate({
    'scrollTop': $('.kek').offset().top
  }, 1000);
});


$(document).on('click', '.payment_method', function(){

  var type=$(this).data('type');
  $('.payment_method').css('border','2px solid white');
  $(this).css({'border':'2px solid orange', 'border-radius':'5px'});

  $('.payment_button').attr('href','/payment/'+type)

});