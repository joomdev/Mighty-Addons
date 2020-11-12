(function ($) {
  "use strict";

  var Mighty_Addons = {

    Mighty_WrapperLink: function ( $scope, $ ) {

      if( $scope.data('mt-wrapperlink') ) {
        var url = $scope.data('mt-wrapperlink');
        var isExternal = $scope.data('mt-wrapperlink-external');
        var selector = $('[data-mt-wrapperlink]');

        $( selector ).on( 'click', function() {

          if ( isExternal ) {
            window.open( url, '_blank' );
          } else {
            window.location.href = url;
          }

        });
      }
    }

  }

  $(window).on('elementor/frontend/init', function () {

    elementorFrontend.hooks.addAction( 'frontend/element_ready/global', Mighty_Addons.Mighty_WrapperLink );

  });

})(jQuery);
