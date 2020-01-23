// Make sure cards are squares

var cards = document.getElementsByClassName("card");
for (card of cards) {
  var width = window.getComputedStyle(card).getPropertyValue("width");
  card.style.height = width;
}
