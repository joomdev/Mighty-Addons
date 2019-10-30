(function ($) {

  var WidgetTestimonialHandler = function ($scope, $) {
    var slidesToShow     = $('.mighty-testimonial').data('show-slides');
    var slidesToScroll   = $('.mighty-testimonial').data('scroll-slides');
    var autoplayStatus   = $('.mighty-testimonial').data('autoplay-status');
    var autoplaySpeed    = $('.mighty-testimonial').data('autoplay-speed');
    var transitionSpeed  = $('.mighty-testimonial').data('transition-speed');
    var pauseOnHover     = $('.mighty-testimonial').data('hover-pause');
    var infiniteLoop     = $('.mighty-testimonial').data('infinite-looping');
    var transitionSpeed  = $('.mighty-testimonial').data('transition-speed');

    var obj = $scope;
    var el = $(obj).find('.mighty-testimonial-wrapper').attr('id');

    $("#"+el + " .mighty-testimonial").slick({
      infinite: infiniteLoop,
      speed: transitionSpeed,
      autoplay: autoplayStatus,
      autoplaySpeed: autoplaySpeed,
      slidesToShow: slidesToShow,
      slidesToScroll: slidesToScroll,
      pauseOnHover: pauseOnHover,
      prevArrow: $("#" + el + ' .prev'),
      nextArrow: $("#" + el + ' .next'),
    });
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/testimonial.default', WidgetTestimonialHandler);
  });
})(jQuery);