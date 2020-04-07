(function ($) {

    var WidgetMailchimpHandler = function ( $scope, $ ) {
        var sel = $scope.find( '.mighty-maichimp-form' );
        var mcList = sel.data( 'mclist' );

        $( sel[0] ).on( 'submit', function( e ) {
            e.preventDefault();

            var data = $( sel[0]).find( '.mailchimp-field input' ).serialize() + "&list=" + mcList;
            $.ajax({
                url: MightyAddons.ajaxUrl,
                type: 'post',
                data: {
                    action: MightyAddons.mailchimpAction,
                    fields: data,
                },
                success: function( response ) {
                    console.log( 'success' );
                },
                error: function() {
                    console.log( 'error' );
                }
            });
        });
    };

    // Make sure you run this code under Elementor.
    $(window).on( 'elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/mt-mailchimp.default', WidgetMailchimpHandler );
    });
})(jQuery);