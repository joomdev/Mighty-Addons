(function ($) {

    var WidgetAccordionHandler = function ($scope, $) {
        var acc = $scope.find(".accordion");
        var openMultiple = $scope.find(".mighty-accordion").data('enable-multiple');
        var firstActive = $scope.find(".mighty-accordion").data('first-active');
        var openAll = $scope.find(".mighty-accordion").data('open-all');

        if ( firstActive == "active" ) {
            var firstElement = $scope.find(".mighty-accordion .mt-panel .accordion")[0];
            firstElement.classList.add("active");
            firstElement.nextElementSibling.style.maxHeight = firstElement.nextElementSibling.scrollHeight + "px";
        }
        
        for (var i = 0; i < acc.length; i++) {

            if ( openAll == "active" ) {
                acc[i].classList.add("active");
                acc[i].nextElementSibling.style.maxHeight = acc[i].nextElementSibling.scrollHeight + "px";
            }
            
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                
                var currentAccordion = this;
                
                var panel = this.nextElementSibling;

                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }

                // When multiple is off
                if ( openMultiple === "disable" ) {
                    // Remove "active" class from inactive accordions
                    var accordions = document.getElementsByClassName("accordion");
                    if (accordions.length > 0) {
                        for ( var j = 0; j < accordions.length; j++ ) {
                            if ( currentAccordion !== accordions[j] ) {
                                accordions[j].classList.remove("active");
                            }
                        }
                    }

                    var panels = document.getElementsByClassName("panel");
                    if (panels.length > 0) {
                        for (var k = 0; k < panels.length; k++) {
                            if ( panel !== panels[k] ) {
                                panels[k].style.maxHeight = null;
                            }
                        }
                    }
                }
                
            });
        }
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/mt-accordion.default', WidgetAccordionHandler);
    });
})(jQuery);