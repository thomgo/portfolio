// ~~~~~~~~~~~~~~~~~~~Appear effect for the h1 and h2 on the landing page

// Hide the h1 and h2 at the beginning
$(".landing h1, .landing h2").hide();

// cascade apparition for h1 and h2 with delay
$(".landing h1").delay(500).fadeIn(1500, function(){
  $(".landing h2").slideToggle();
});


// // ~~~~~~~~~~~~~~~~~~Show the cards text div on smartphones
//
// $(".hide-button").hide();
//
// $(".show-button").click(function showAll(){
//   $(this).siblings(".card-text").css('height', '100%');
//   $(this).hide();
//   $(this).siblings(".hide-button").show();
// });
//
// $(".hide-button").click(function hideAll(){
//   $(this).siblings(".card-text").css('height', '100px');
//   $(this).hide();
//   $(this).siblings(".show-button").show();
// });
//
// // ~~~~~~~~~~~~~~~~~~~Transparency on menu when scroll
//
// // Jumbotron top position
//  var top_height = $(".jumbotron").offset().top;
//
// $(window).scroll(function (){
//
// // When scroll over the jumbotron the nav gets some transparency
//   if ($(window).scrollTop() > top_height) {
//   $("nav").css('background-color', 'rgba(55, 58, 60, 0.92)');
// }
//
// // Otherwise full color
//   else {
//     $("nav").css('background-color', 'rgb(55, 58, 60)');
//   }
//
// });
//
// // ~~~~~~~~~~~~~~~~~ Overlay on card hover
//
// if (window.matchMedia("(min-width: 1280px)").matches) {
//
//   // Hide the red button on desktops
//     $(".btn-danger").hide();
//
//     // Variables which define the card overlay and the new red button
//     var cardOverlay = $('<a href="" target=""><div class="card-overlay"></div></a>');
//     var button = $("<a href='' target='' class='btn btn-danger'><i class='fa fa-search-plus' aria-hidden='true'></i></a>").css('margin-top', '40%');
//
// // When enter on a card
//     $(".card").mouseenter(function(){
//
//       // Get the link of the website or the document
//       var link = $(this).children("a").attr("href");
//       var target = $(this).children("a").attr("target");
//
//       // Add the overlay as the first child
//       $(this).prepend(cardOverlay);
//       // Link the overlay to the right document or website
//       $(this).children("a").attr("href", link).attr("target", target);
//       // Add the button to the overlay
//       $(".card-overlay").append(button);
//       // Link the button to the right document or website
//       $(".card-overlay .btn-danger").attr("href", link).attr("target", target);
//       $(".card-overlay .btn-danger").hide().fadeIn();
//     });
//
// // When leave the card
//     $(".card").mouseleave(function(){
//       // Get ride of the button
//       $(this).find(button).remove();
//       // Get ride of the overlay
//       $(this).find(cardOverlay).remove();
//     });
// }
