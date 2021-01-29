// Change Navbar Mode
$(window).scroll(function () {
    var sticky = $('.fixed-top'),
      scroll = $(window).scrollTop(),
      windowWidth = $(window).width();

    if (!$('body').hasClass('page-1')) {
      if (windowWidth > 992) {
        if (scroll >= 100) {
          sticky.removeClass('navbar-dark').addClass('nav-sticky navbar-light')
        } else {
          sticky.removeClass('nav-sticky navbar-light').addClass('navbar-dark');
        }
      }
    }
});

// Navbar Home
var sticky = $('.fixed-top'),
  windowWidth = $(window).width();

if (windowWidth <= 992) {
  sticky.removeClass('navbar-dark');
  sticky.addClass('nav-sticky navbar-light');
}

// Owl Carousel - Do'a Donatur
$(".owl-carousel").owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  navText: ["<i class='fa fa-chevron-left text-white'></i>", "<i class='fa fa-chevron-right text-white'></i>"]
});