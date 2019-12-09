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

        $('.ma-settings-header-bar .ma-save-button').text('✅ Updated');
        $('#mighty-settings .ma-save-button').text('✅ Updated');

        setTimeout(function() {
            $('.ma-settings-header-bar .ma-save-button').text('Save Settings');
            $('#mighty-settings .ma-save-button').text('Save Settings');
        }, 2000);
        
        // Disable after save
        $('.ma-settings-header-bar .ma-save-button').attr('disabled', 'disabled'); // Header Button
        $('#mighty-settings .ma-save-button').attr('disabled', 'disabled'); // Form's Button
    });
    
    // Click event - Header Button
    $('.ma-settings-header-bar .ma-save-button').on('click', function () {
        $("form#mighty-settings .ma-save-button").trigger('click');
    });
    
    // Enable all button
    $('.ma-gl-cnt-right #enable-all').on('click', function() {
        $(".switch-input").attr('checked', 'checked');
    });
    
    // Disable all button
    $('.ma-gl-cnt-right #disable-all').on('click', function() {
        $(".switch-input").removeAttr('checked');
    });

    // Detecting changes (Switch)
    $('#mighty-settings .switch').off('click').on('click', function() {
        $('.ma-settings-header-bar .ma-save-button').removeAttr('disabled'); // Header Button
        $('#mighty-settings .ma-save-button').removeAttr('disabled'); // Form's Button
    });

    // Detecting changes (Enable/Disable All)
    $('#widgets .ma-btn-action').on('click', function() {
        $('.ma-settings-header-bar .ma-save-button').removeAttr('disabled'); // Header Button
        $('#mighty-settings .ma-save-button').removeAttr('disabled'); // Form's Button
    });

}) ( jQuery );