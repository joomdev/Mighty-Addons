( function( $ ) {

    function saveAddons() {
        $.ajax({
            url: MightyAddonsDashboard.ajaxUrl,
            type: 'post',
            data: {
                action: 'save_mighty_addons_settings',
                security: MightyAddonsDashboard.nonce,
                fields: $('form#mighty-settings input.mighty-addons-free').serialize(),
                proFields: $('form#mighty-settings input.mighty-addons-pro').serialize()
            },
            success: function(response) {
                console.log('successfully saved!');
            },
            error: function() {
                console.log('#212 Something went wrong!');
            }
        });
    }

    function saveIntegrationSettings() {
        $.ajax({
            url: MightyAddonsDashboard.ajaxUrl,
            type: 'post',
            data: {
                action: 'save_mighty_addons_integration',
                security: MightyAddonsDashboard.nonce,
                fields: $('form#mighty-integration-settings').serialize()
            },
            success: function() {
                console.log('Successfully saved!');
            },
            error: function() {
                console.log('#213 Something went wrong!');
            }
        });
    }

    function tabsStatus(tab, source, obj) {
        $('.ma-tabs li').removeClass('active');
        $('#toplevel_page_mighty-addons-home .wp-submenu li').removeClass('current');
        // Modifies Tab active status
        if ( source == "sidebar" ) {
            $('.ma-tabs li a[href="'+ tab +'"]').parent('li').addClass('active');
            $(obj).parent('li').addClass('current');
        } else {
            var url = ( tab == "#general" ? 'admin.php?page=mighty-addons-home' : 'admin.php?page=mighty-addons-home'+tab );
            $('#toplevel_page_mighty-addons-home .wp-submenu li a[href="'+ url +'"]').parent('li').addClass('current');
            $(obj).addClass('active');
        }
        $('.ma-tabs-content').hide();
    }

    // Tabs Setting
    if( $('.ma-tabs li:last-child a span').html() == "Boring Stuff" ) {
        $('.ma-tabs li:last-child').addClass('active');
    } else {
        $('.ma-tabs li:first-child').addClass('active');
    }
    $('.ma-tabs-content').hide();
    $('.ma-tabs-content:first').show();

    // Tabs Events
    $('.ma-tabs li').click(function() {
        var activeTab = $(this).find('a').attr('href');
        tabsStatus(activeTab, 'topbar', this);
        $( activeTab ).show();
        return false;
    });

    // Sidebar Events
    $("#toplevel_page_mighty-addons-home .wp-submenu li a").click( function() {
        var activeTab = $( this ).attr( "href" ).substr( $(this).attr("href").indexOf("#") );
        activeTab = ( activeTab === "e" ? "#general" : activeTab );
        tabsStatus(activeTab, 'sidebar', this);
        $( activeTab ).show();
        return false;
    });

    // OnLoad Event
    if( location.hash ) {
        var activeTab = location.hash;
        tabsStatus( activeTab, 'sidebar', this );
        $( activeTab ).show();
    }

    // Standalone Events
    $(".ma-tabs-content .ma-element .white-label-settings").click( function() {
        var activeTab = $(this).attr("href").substr($(this).attr("href").indexOf("#"));
        activeTab = activeTab === "e" ? "#general" : activeTab;
        tabsStatus(activeTab, 'standalone', this);
        $(activeTab).show();
        return false;
    });

    // Submit event - Form button
    $('form#mighty-settings').on('submit', function (e) {
        e.preventDefault();
        saveAddons();

        $('.ma-settings-header-bar .ma-save-button').html('<span class="updated-widgets dashicons dashicons-yes-alt"></span> Updated');
        $('#mighty-settings .ma-save-button').html('<span class="updated-widgets dashicons dashicons-yes-alt"></span> Updated');

        setTimeout(function() {
            $('.ma-settings-header-bar .ma-save-button').text('Save Settings');
            $('#mighty-settings .ma-save-button').text('Save Settings');
        }, 2000);
        
        // Disable after save
        $('.ma-settings-header-bar .ma-save-button').attr('disabled', 'disabled'); // Header Button
        $('#mighty-settings .ma-save-button').attr('disabled', 'disabled'); // Form's Button
    });

    // Integration Settings
    $('form#mighty-integration-settings').on('submit', function (e) {
        e.preventDefault();
        saveIntegrationSettings();

        $('#mighty-integration-settings .ma-save-button').html('<span class="updated-widgets dashicons dashicons-yes-alt"></span> Updated');

        setTimeout(function() {
            $('#mighty-integration-settings .ma-save-button').text('Save Settings');
        }, 2000);
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

    $('#mighty-settings .switch .switch-input').on('click', function() {
        var checked = $(this).attr('checked');
        if ( typeof checked == typeof undefined && checked !== 'checked' ) {
            $(this).attr('checked', 'checked');
        } else {
            $(this).removeAttr('checked');
        }
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

    $('#integrations #weather-api').on('change', function() {
        var api = $(this).val();
        if ( api == "openweather" ) {
            $('#integrations .ma-element .api-key-weatherbit').css('display', 'none');
            $('#integrations .ma-element .api-key-openweather').css('display', 'block');
        } else if ( api == "weatherbit" ) {
            $('#integrations .ma-element .api-key-openweather').css('display', 'none');
            $('#integrations .ma-element .api-key-weatherbit').css('display', 'block');
        } else {
            $('#integrations .ma-element .api-key-openweather').css('display', 'none');
            $('#integrations .ma-element .api-key-weatherbit').css('display', 'none');
        }

        if ( api === "-1" ) {
            $('#integrations #weather-api-key').css('display', 'none');
        } else {
            $('#integrations #weather-api-key').css('display', 'block');
        }
    });

    // Stub clicked
    $( '.stub-widget' ).on( 'click', function() {
        
        var modal = $("#proModal");
        modal.css( 'display', 'block' );

        window.onclick = function (event) {
            if (event.target == modal[0]) {
                modal.css('display', 'none');
                $('body').removeClass('modal-open');
            }
        }

        setTimeout(function() {
            modal.css('display', 'none');
        }, 3000);
        
    });

}) ( jQuery );