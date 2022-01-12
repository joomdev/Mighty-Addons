(function ($) {
  "use strict";

  var Mighty_Addons = {

    Mighty_WrapperLink: function ( $scope, $ ) {

      if( $scope.data( 'mt-wrapperlink' ) || $scope.data( 'mt-hashed-wrapperlink' ) ) {

        var isExternal = $scope.data( 'mt-wrapperlink-external' );

        if ( ! $scope.data( 'mt-wrapperlink' ) ) {
          return;
        }

        
        $scope.on( 'click', function( e ) {
          e.stopPropagation();

          let url = this.getAttribute( 'data-mt-wrapperlink' );

          if ( isExternal ) {
            window.open( url, '_blank' );
          } else {
            if ( $scope.data( 'mt-wrapperlink' ) ) {
              window.location.href = url;
            } else {
              $( 'html, body' ).animate( { scrollTop: $( url ).offset().top }, 1000 );
            }
          }
        });

      }
    }

  }

  $(window).on('elementor/frontend/init', function () {

    elementorFrontend.hooks.addAction( 'frontend/element_ready/global', Mighty_Addons.Mighty_WrapperLink );

  });

})(jQuery);
