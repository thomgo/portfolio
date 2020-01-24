// // ~~~~~~~~~~~~~~~~~~~Transparency on menu when scroll
 var top_height = $(".jumbotron").offset().top;

$(window).scroll(function (){
// When scroll over the jumbotron the nav gets some transparency
  if ($(window).scrollTop() > top_height) {
    $("nav").css('opacity', 0.9);
}
// Otherwise full color
  else {
    $("nav").css('opacity', 1);
  }
});
