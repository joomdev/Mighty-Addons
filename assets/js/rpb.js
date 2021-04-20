(function ($) {
  "use strict";

  window.onscroll = function() {readingProgressBar()};

  // When no scroll is initialized
  if ( document.getElementById( "ma-btt-rpb" ) ) {

    var progressPath = document.querySelector( '.ma-progress-wrap path.bar' );
    progressPath.style.transition = progressPath.style.WebkitTransition = 'none';

  }

  // Back to top event listener
  $( '#ma-btt-rpb' ).on( 'click', function( event ) {
    event.preventDefault();
    $( 'html, body' ).animate({
      scrollTop: 0
    }, 550 );
    return false;
  });

  // Updating progress
  function readingProgressBar() {

    // View 1
    if( document.getElementById( "ma-rpb" ) ) {
      
      var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
      var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      var scrolled = ( winScroll / height ) * 100;

      document.querySelector( "#ma-rpb .ma-rpb-progress-bar" ).style.width = scrolled + "%";
    }

    // View 2
    if ( document.getElementById( "ma-btt-rpb" ) ) {

      var progressPath = document.querySelector( '.ma-progress-wrap path.bar' );
      var pathLength = progressPath.getTotalLength();
      progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
      progressPath.style.strokeDashoffset = pathLength;
      progressPath.getBoundingClientRect();
      progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';

      var scroll = $(window).scrollTop();
      var height = $(document).height() - $(window).height();
      var progress = pathLength - (scroll * pathLength / height);
      progressPath.style.strokeDashoffset = progress;

      // Activate progress bar after defined limit
      $( window ).on( 'scroll', function() {
        if ( $(this).scrollTop() > 50 ) {
          $( '.ma-progress-wrap' ).addClass( 'active-progress' );
        } else {
          $( '.ma-progress-wrap' ).removeClass( 'active-progress' );
        }
      });
    }

  }

  // Dynamic Progress Bar for Elementor Editor
  $(window).on('elementor/frontend/init', function () {

    if ( elementorFrontend.isEditMode() ) {

      let rpbHtml = '<div id="ma-rpb" class="ma-rpb ma-rpb-header"><div class="ma-rpb-progress-container"><div class="ma-rpb-progress-bar"></div></div></div>';
      
      // On Enable RPB
      elementor.settings.page.addChangeCallback( 'ma_enable_rpb', function( value ) {
        if( value == 'yes' ) {
          $( elementorFrontend.elements.$body ).append( rpbHtml );
        } else {
          if ( $( elementorFrontend.elements.$body ).find( '.ma-rpb' ).length ) {
            $( elementorFrontend.elements.$body ).find( '.ma-rpb' ).remove();
          }
        }
      });

      // On Hide On Change
      elementor.settings.page.addChangeCallback( 'ma_hide_on_desktop', function( value ) {
        $( elementorFrontend.elements.$body ).find( '.ma-rpb' ).attr( 'data-hide-on-desktop', value );  
      });
      elementor.settings.page.addChangeCallback( 'ma_hide_on_tablet', function( value ) {
        $( elementorFrontend.elements.$body ).find( '.ma-rpb' ).attr( 'data-hide-on-tablet', value );  
      });
      elementor.settings.page.addChangeCallback( 'ma_hide_on_mobile', function( value ) {
        $( elementorFrontend.elements.$body ).find( '.ma-rpb' ).attr( 'data-hide-on-mobile', value );  
      });

      // On Position change
      elementor.settings.page.addChangeCallback( 'ma_position', function( value ) {
        $( elementorFrontend.elements.$body ).find( '.ma-rpb-header' ).attr( 'data-position', value );
      });

      // On view change
      elementor.settings.page.addChangeCallback( 'ma_select_view', function( value ) {
        // Removing old instances
        $( elementorFrontend.elements.$body ).find( '.ma-rpb' ).remove();
        
        if( value == 'view1' ) {
          $( elementorFrontend.elements.$body ).append( rpbHtml );
        } else if( value == 'view2' ) {

          let bttIcon = elementor.getPanelView().getCurrentPageView().model.attributes.ma_rpb_icon.value;
          let hideOnDesktop = elementor.getPanelView().getCurrentPageView().model.attributes.ma_hide_on_desktop;
          let hideOnTablet = elementor.getPanelView().getCurrentPageView().model.attributes.ma_hide_on_tablet;
          let hideOnMobile = elementor.getPanelView().getCurrentPageView().model.attributes.ma_hide_on_mobile;

          let bttHtml = '<div data-hide-desktop="' + hideOnDesktop + '" data-hide-tablet="' + hideOnTablet + '" data-hide-mobile="' + hideOnMobile + '" id="ma-btt-rpb" class="ma-rpb ma-progress-wrap"><svg class="progress-circle" width="100%" height="100%" viewBox="-1 -1 102 102"><path class="bar-bg" d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" /> <path class="bar" d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" /> <div class="ma-rpb-icon"><i class="'+ bttIcon +'"></i></div> </svg></div>';

          $( elementorFrontend.elements.$body ).append( bttHtml );
          
          // Attaching event listener
          $( '#ma-btt-rpb' ).on( 'click', function( event ) {
            event.preventDefault();
            $( 'html, body' ).animate({
              scrollTop: 0
            }, 550 );
            return false;
          })
        }
      });

      // On Icon change
      elementor.settings.page.addChangeCallback( 'ma_rpb_icon', function( value ) {
        $( elementorFrontend.elements.$body ).find( '#ma-btt-rpb .ma-rpb-icon i' ).attr( 'class', value['value'] );
      });

    }
  });

})(jQuery);