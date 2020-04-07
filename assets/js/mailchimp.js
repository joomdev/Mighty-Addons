(function ($) {

    var WidgetMailchimpHandler = function ( $scope, $ ) {
        var sel = $scope.find( '.mighty-maichimp-form' );
        var mcList = sel.data( 'mclist' );
        var successMsg = sel.data( 'success-msg' );
        var errorMsg = sel.data( 'error-msg' );
        var submitAction = sel.data( 'after-submission' );
        if ( submitAction == "different" ) {
            var link = sel.data( 'link' );
            var external = sel.data( 'external' );
            var nofollow = sel.data( 'nofollow' );
		}

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
                    if ( submitAction == "different" ) {
                        if ( external ) {
                            window.open(link, '_blank');
                        } else {
                            window.location = link;
                        }
                    } else {
                        $( sel[0] ).append('<p class="mailchiimp-message mailchimp-success">' + successMsg + '</p>');
                    }
                },
                error: function() {
                    $( sel[0] ).append('<p class="mailchiimp-message mailchimp-error">' + errorMsg + '</p>');
                }
            });
        });
    };

    // Make sure you run this code under Elementor.
    $(window).on( 'elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/mt-mailchimp.default', WidgetMailchimpHandler );
    });
})(jQuery);