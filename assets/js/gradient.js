(function ($) {
    
    var randomizeGradient = function( panel, model, view ) {

        $(panel.el).on('click', '#elementor-controls .elementor-control-randomize_gradient button', function () {
            var hex1 = '#' + (Math.random() * 0xFFFFFF << 0).toString(16);
            var hex2 = '#' + (Math.random() * 0xFFFFFF << 0).toString(16);

            $(view.$el).find('.elementor-widget-container .mighty-gradient-heading').css('background', '-webkit-linear-gradient(45deg, ' + hex1 + ', ' + hex2 + ' 80%)');
            $(view.$el).find('.elementor-widget-container .mighty-gradient-heading').css('-webkit-background-clip', 'text');
            $(view.$el).find('.elementor-widget-container .mighty-gradient-heading').css('-webkit-text-fill-color', 'transparent');
        });
    };

    $(window).on('elementor/frontend/init', function () {
        elementor.hooks.addAction( 'panel/open_editor/widget/mt-gradient-heading', randomizeGradient);
    });
})(jQuery);
