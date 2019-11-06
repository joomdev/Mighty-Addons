(function ($) {

    var WidgetCounterHandler = function ($scope, $) {
        
        $scope.find('.mighty-counter .count').each(function () {
            $(this).prop('Counter', $(this).data('start-number')).animate({
                Counter: $(this).text()
            }, {
                duration: $(this).data('animation'),
                easing: 'swing',
                step: function (now) {
                    if ( $(this).data('num-separator') == "none" ) {
                        $(this).text(Math.ceil(now));
                    } else if ( $(this).data('num-separator') == "comma" ) {
                        $(this).text(Math.ceil(now).toLocaleString());
                    } else if ( $(this).data('num-separator') == "dot" ) {
                        $(this).text(Math.ceil(now).toLocaleString().replace(/,/g, "."));
                    }
                }
            });
        });
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/mt-counter.default', WidgetCounterHandler);
    });
})(jQuery);