(function ($) {

    var WidgetBeforeAfterHandler = function ($scope, $) {
        
        var sliderOrientation   = $scope.find('.mighty-before-after').data('slider-orientation');
        var moveOnHover         = $scope.find('.mighty-before-after').data('enable-hover');
        var enableOverlay       = !$scope.find('.mighty-before-after').data('enable-overlay');
        var handleOffset        = ($scope.find('.mighty-before-after').data('handle-offset'))/100; // Divided by hundred bcos offset requires fraction
        var beforeLabel         = $scope.find('.mighty-before-after').data('before-label');
        var afterLabel          = $scope.find('.mighty-before-after').data('after-label');
        
        $scope.find('.mighty-before-after').twentytwenty({
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