// ~~~~~~~~~~~~~~~~~~~Appear effect for the h1 and h2 on the landing page

// Hide the h1 and h2 at the beginning
$(".landing h1, .landing h2").hide();

// cascade apparition for h1 and h2 with delay
$(".landing h1").delay(500).fadeIn(1500, function(){
  $(".landing h2").slideToggle();
});
