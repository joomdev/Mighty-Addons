(function ($) {
  "use strict";

  var Mighty_Addons = {

    Mighty_ReadingProgressBar: function ($scope, $) {

      window.onscroll = function() {myFunction()};

      function myFunction() {
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (winScroll / height) * 100;

        if( document.getElementById( "myBar" ) ) {
          document.getElementById( "myBar" ).style.width = scrolled + "%";
        }
      }

    }

  }

  $(window).on('elementor/frontend/init', function () {

    elementorFrontend.hooks.addAction('frontend/element_ready/global', Mighty_Addons.Mighty_ReadingProgressBar);

    if ( elementorFrontend.isEditMode() ) {
      elementor.settings.page.addChangeCallback( 'ma_enable_rpb', function( value ) {
        
        if( value == 'yes' ) {

          let html = '<div class="ma-rpb-header"><div class="ma-rpb-progress-container"><div class="ma-rpb-progress-bar" id="myBar"></div></div></div>';

          jQuery(elementorFrontend.elements.$body).append(html);

        } else {

          if ( jQuery(elementorFrontend.elements.$body).find('.ma-rpb-header').length ) {
            jQuery(elementorFrontend.elements.$body).find('.ma-rpb-header').remove();
          }

        }
        
      });
    }
      

  });

})(jQuery);