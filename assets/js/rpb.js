(function ($) {
  "use strict";

  window.onscroll = function() {readingProgressBar()};

  function readingProgressBar() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var scrolled = (winScroll / height) * 100;

    if( document.getElementById( "ma-rpb" ) ) {
      document.getElementById( "ma-rpb" ).style.width = scrolled + "%";
    }
  }

  var Mighty_Addons = {

    Mighty_ReadingProgressBar: function ($scope, $) {

    }

  }

  // Dynamic Progress Bar for Elementor Editor
  $(window).on('elementor/frontend/init', function () {

    elementorFrontend.hooks.addAction('frontend/element_ready/global', Mighty_Addons.Mighty_ReadingProgressBar);

    if ( elementorFrontend.isEditMode() ) {
      elementor.settings.page.addChangeCallback( 'ma_enable_rpb', function( value ) {
        
        if( value == 'yes' ) {

          let settings = elementor.settings.page.model.attributes;
          console.log( 'height', settings.ma_height );
          
          let html = '<div class="ma-rpb-header"><div class="ma-rpb-progress-container"><div class="ma-rpb-progress-bar" id="ma-rpb"></div></div></div>';



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