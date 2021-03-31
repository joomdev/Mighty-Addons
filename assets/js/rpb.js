(function ($) {
  "use strict";

  var Mighty_Addons = {

    Mighty_ReadingProgressBar: function ($scope, $) {

      window.onscroll = function() {myFunction()};

      function myFunction() {
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (winScroll / height) * 100;
        document.getElementById("myBar").style.width = scrolled + "%";
      }

    }

  }

  $(window).on('elementor/frontend/init', function () {

    elementorFrontend.hooks.addAction('frontend/element_ready/global', Mighty_Addons.Mighty_ReadingProgressBar);

  });

})(jQuery);