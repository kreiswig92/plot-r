// Repositions the sidebar to be positioned at the top of the page,
// This is needed to fix the positioning when the header is scrolled up.


$(document).ready(function(){
  $(window).scroll(positionSidebar);
});


function positionSidebar() {
  var windowPos = $(window).scrollTop();
  var sidebar = $('.sidebar');
  if(windowPos < 130) {
    sidebar.css('top', 175 - windowPos + 'px');
  }
  else {
    sidebar.css('top', 45 + 'px');
  }
}
