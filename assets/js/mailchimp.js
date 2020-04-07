(function ($) {

    var WidgetMailchimpHandler = function ( $scope, $ ) {
        var sel = $scope.find( '.mighty-maichimp-form' );
        var mcList = sel.data( 'mclist' );
        var successMsg = sel.data( 'success-msg' );
        var errorMsg = sel.data( 'error-msg' );

        $( sel[0] ).on( 'submit', function( e ) {
            e.preventDefault();

            var data = $( sel[0] ).find( '.mailchimp-field input' ).serialize() + "&list=" + mcList;
            $.ajax({
                url: MightyAddons.ajaxUrl,
                type: 'post',
                data: {
                    action: MightyAddons.mailchimpAction,
                    fields: data,
                },
                success: function() {
                    $( sel[0] ).append('<p class="mailchimp-success">' + successMsg + '</p>');
                },
                error: function() {
                    $( sel[0] ).append('<p class="mailchimp-error">' + errorMsg + '</p>');
                }
            });
        });
    };

    // Make sure you run this code under Elementor.
    $(window).on( 'elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/mt-mailchimp.default', WidgetMailchimpHandler );
    });
})(jQuery);