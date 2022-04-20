(function ($) {

    var WidgetContactFormHandler = function ( $scope, $ ) {

        let form_id = $scope[0].getAttribute('data-id');
        var sel = $scope.find( '.mt-c-form-'+form_id );
        let CaptchaType = sel.data( 'captcha_type' );
        let enableCaptcha = sel.data( 'enable_captcha' );
        let senderEmail = sel.data( 'sender_email' );
        let thankyouMsg = sel.data( 'thankyoumsg' );
        let redirectUrl = sel.data( 'redirect_url' );
        let templateData = sel.data( 'template_data' );
        let contactFormData = sel.data( 'form_data' );
        let defaultCaptchaValue = '';
        if ( CaptchaType == 'default'  && enableCaptcha == 'yes' ) {
            defaultCaptchaValue = sel.data( 'dc_value' );
        }
        let emailValues = sel.data( 'email_value' );
        var form = sel[0];
        let submitButton = sel.find('button')[0];

        $( form ).on( 'submit', function( e ) {

            submitButton.classList.add("form-loading");
            submitButton.setAttribute('disabled','disabled');

            e.preventDefault();
            e.stopPropagation();

            var data = new FormData( form );
            data.append('action',MightyContactForm.contactformAction );

            if( CaptchaType == 'default' && defaultCaptchaValue && enableCaptcha == 'yes' ) {
                data.append( 'defaultCaptchaValue', defaultCaptchaValue );
            }
            if( enableCaptcha == 'yes' ) {
                data.append( 'CaptchaType', CaptchaType );
            }
            
            if( thankyouMsg ) {
                data.append( 'thankyouMsg', thankyouMsg );
            }

            if( templateData ) {
                data.append( 'template_data', templateData );
                data.append( 'contactFormData', JSON.stringify( contactFormData ) );
            }
            
            if( emailValues ) {
                data.append( 'emailValues', JSON.stringify( emailValues ) );
            }
            data.append( 'enableCaptcha', enableCaptcha );
            data.append( 'senderEmail', senderEmail );
            data.append( 'action', MightyContactForm.contactformAction );

            jQuery.ajax( {
                url: MightyContactForm.ajaxUrl,
                type: 'post',
                data:data,
                processData: false,
                contentType: false,   
                success: function( data ) {
                    data = JSON.parse( data );
                    if( thankyouMsg ) {
                        $( form ).find('.mt-c-form-fields-wrapper-inner')[0].insertAdjacentHTML('afterend', data.msg);;
                        if( data.result ) {
                            $( form ).trigger('reset');
                        }
                    }
                    if( redirectUrl && data.result ) {
                        window.location = redirectUrl;
                    }
                    submitButton.classList.remove("form-loading");
                    submitButton.removeAttribute('disabled');
                },
                error: function( data ) {
                    console.log(data);
                }
            } );
           
        });
    };

    // Make sure you run this code under Elementor.
    $(window).on( 'elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/mt-contactform.default', WidgetContactFormHandler );
    });

    })(jQuery);
