( function( $ ) {

    function saveAddons() {
        $.ajax({
            url: settings.ajaxurl,
            type: 'post',
            data: {
                action: 'save_mighty_addons_settings',
                security: settings.nonce,
                fields: $('form#mighty-settings').serialize(),
            },
            success: function(response) {
                console.log('successfully saved!');
            },
            error: function() {
                console.log('#212 Something went wrong!');
            }
        });
    }

    // Submit event - Form button
    $('form#mighty-settings').on('submit', function (e) {
        e.preventDefault();
        saveAddons(settings);
    });
    
    // Click event - Header Button
    $('.ma-settings-header-bar .ma-save-button').on('click', function () {
        $("form#mighty-settings .ma-save-button").trigger('click');
    });

}) ( jQuery );