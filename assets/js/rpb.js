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

  // Dynamic Progress Bar for Elementor Editor
  $(window).on('elementor/frontend/init', function () {

    if ( elementorFrontend.isEditMode() ) {
      
      // On Enable RPB
      elementor.settings.page.addChangeCallback( 'ma_enable_rpb', function( value ) {
        if( value == 'yes' ) {
          let html = '<div class="ma-rpb-header"><div class="ma-rpb-progress-container"><div class="ma-rpb-progress-bar" id="ma-rpb"></div></div></div>';
          jQuery( elementorFrontend.elements.$body ).append( html );
        } else {
          if ( jQuery( elementorFrontend.elements.$body ).find( '.ma-rpb-header' ).length ) {
            jQuery( elementorFrontend.elements.$body ).find( '.ma-rpb-header' ).remove();
          }
        }
      });

      // On Hide On Change
      elementor.settings.page.addChangeCallback( 'ma_hide_on', function( value ) {
        jQuery( elementorFrontend.elements.$body ).find( '.ma-rpb-header' ).attr( 'data-hide-on', value );  
      });

      // On Position change
      elementor.settings.page.addChangeCallback( 'ma_position', function( value ) {
        jQuery( elementorFrontend.elements.$body ).find( '.ma-rpb-header' ).attr( 'data-position', value );
      });

    }
      

  });

})(jQuery);