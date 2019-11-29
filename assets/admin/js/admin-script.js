( function( $ ) {

    $('form#mighty-settings').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: settings.ajaxurl,
            type: 'post',
            data: {
                action: 'save_mighty_addons_settings',
                security: settings.nonce,
                fields: $('form#mighty-settings').serialize(),
            },
            success: function(response) {
                console.log($('form#mighty-settings').serialize());
                console.log('successfully saved!');
            },
            error: function() {
                console.log('horrendously unsaved!');
            }
        });
    });

}) ( jQuery );