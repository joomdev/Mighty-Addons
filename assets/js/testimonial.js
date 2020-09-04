(function ($) {

  var WidgetTestimonialHandler = function ($scope, $) {
    var slidesToShowDesktop   = $scope.find('.mighty-testimonial').data('show-slides-desktop');
    var slidesToShowTablet    = $scope.find('.mighty-testimonial').data('show-slides-tablet');
    var slidesToShowMobile    = $scope.find('.mighty-testimonial').data('show-slides-mobile');
    var slidesToScrollDesktop = $scope.find('.mighty-testimonial').data('scroll-slides-desktop');
    var slidesToScrollTablet  = $scope.find('.mighty-testimonial').data('scroll-slides-tablet');
    var slidesToScrollMobile  = $scope.find('.mighty-testimonial').data('scroll-slides-mobile');
    var autoplayStatus        = $scope.find('.mighty-testimonial').data('autoplay-status');
    var autoplaySpeed         = $scope.find('.mighty-testimonial').data('autoplay-speed');
    var pauseOnHover          = $scope.find('.mighty-testimonial').data('hover-pause');
    var infiniteLoop          = $scope.find('.mighty-testimonial').data('infinite-looping');
    var transitionSpeed       = $scope.find('.mighty-testimonial').data('transition-speed');
    var dots                  = $scope.find('.mighty-testimonial').data('enable-dots');

    $scope.find(".mighty-testimonial").slick({
      infinite: infiniteLoop,
      speed: transitionSpeed,
      autoplay: autoplayStatus,
      autoplaySpeed: autoplaySpeed,
      slidesToShow: slidesToShowDesktop,
      slidesToScroll: slidesToScrollDesktop,
      pauseOnHover: pauseOnHover,
      prevArrow: $scope.find('.mighty-testimonial-wrapper .prev-next .prev'),
      nextArrow: $scope.find('.mighty-testimonial-wrapper .prev-next .next'),
      dots: dots,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: slidesToShowDesktop,
            slidesToScroll: slidesToScrollDesktop
          }
        },
        {
          breakpoint: 900,
          settings: {
            slidesToShow: slidesToShowTablet,
            slidesToScroll: slidesToScrollTablet
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: slidesToShowMobile,
            slidesToScroll: slidesToScrollMobile
          }
        }
      ]
    });
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/mt-testimonial.default', WidgetTestimonialHandler);
  });
})(jQuery);