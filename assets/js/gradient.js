(function ($) {
    
    var randomizeGradient = function( panel, model, view ) {

        if ( $(panel.$el[0]).find("#elementor-panel-content-wrapper .elementor-button").data('event') == "namespace:make:gradient" ) {
            $(panel.$el[0]).find("#elementor-panel-content-wrapper .elementor-button").on('click', function() {
                $(view.$el).find('.elementor-widget-container .mighty-gradient-heading').css('background', '-webkit-linear-gradient(45deg, #33ccff, #ff99cc 80%)');
                $(view.$el).find('.elementor-widget-container .mighty-gradient-heading').css('-webkit-background-clip', 'text');
                $(view.$el).find('.elementor-widget-container .mighty-gradient-heading').css('-webkit-text-fill-color', 'transparent');
            });
        }
    };

    $(window).on('elementor/frontend/init', function () {
        elementor.hooks.addAction( 'panel/open_editor/widget/mt-gradient-heading', randomizeGradient);
    });
})(jQuery);
