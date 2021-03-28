$(function () {

  $('.burger').on('click', () => {
    $('.nav').toggleClass('active');
    $('.burger').toggleClass('active');
  })

  wow = new WOW({
    mobile: false
  })
  wow.init();

});