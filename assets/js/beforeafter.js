(function ($) {

    var WidgetBeforeAfterHandler = function ($scope, $) {

        var el = $($scope).find('.mighty-before-after').attr('id');
        
        var sliderOrientation = $("#"+el).data('slider-orientation');
        var moveOnHover = $("#"+el).data('enable-hover');
        var enableOverlay = !$("#"+el).data('enable-overlay');
        var handleOffset = ($("#"+el).data('handle-offset'))/100; // Divided by hundred bcos offset requires fraction
        var beforeLabel = $("#"+el).data('before-label');
        var afterLabel = $("#"+el).data('after-label');
        
        $("#"+el).twentytwenty({
            orientation: sliderOrientation,
            move_slider_on_hover: moveOnHover,
            no_overlay: enableOverlay,
            default_offset_pct: handleOffset,
            before_label: beforeLabel,
            after_label: afterLabel,
            // move_with_handle_only: false,
            click_to_move: true
        });
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/mt-before-after.default', WidgetBeforeAfterHandler);
    });
})(jQuery);