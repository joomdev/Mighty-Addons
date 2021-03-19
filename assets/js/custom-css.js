jQuery( window ).on( "elementor:init", function() {
    "use strict";

    function applyCustomCss( css, view ) {
        
        if ( ! view ) {
            return; 
        }

        var model = view.model;
        var customCss = model.get('settings').get('ma_custom_css');
        var selector = '.elementor-element.elementor-element-' + model.get('id');

        if ( customCss ) {
            css += customCss.replace(/selector/g, selector);
        }

        return css;
    } 

    elementor.hooks.addFilter( 'editor/style/styleText', applyCustomCss );
});