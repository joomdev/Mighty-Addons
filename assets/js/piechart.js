(function ($) {
    // console.log($scope);
        var WidgetPieDoughnutChartHandler = function ($scope, $) {
    
            var chart = $scope.find('canvas');        
            let chart_labels = chart.attr("data-label");
            let chart_values = chart.attr("data-values");
            let chart_backgroundColor = chart.attr("data-backgroundColor");
            console.log(chart_backgroundColor);
            let chart_type = chart.attr("data-type");
            let legend_style = chart.attr("data-legend_style");
            let legend_position = chart.attr("data-legend_position");
            let legend_alignment = chart.attr("data-legend_alignment");
            let legend_bar_width = chart.attr("data-legend_bar_width");
            let legend_bar_margin = chart.attr("data-legend_bar_margin");
            let legend_label_color = chart.attr("data-legend_label_color");
            let legend_bar_height = chart.attr("data-legend_bar_height");
            let legend_label_font = chart.attr("data-legend_label_font");
            let legend_label_font_size = chart.attr("data-legend_label_font_size");
            let step_value = chart.attr("data-step_value");
            let max_value = chart.attr("data-max_value");
            let min_value = chart.attr("data-min_value");
            var legend_display = (legend_style == 'yes') ? true : false;
            Chart.defaults.font.size = 16;
            
            var myChart = new Chart(chart, {
                type: 'pie',
                data: {
                  labels: chart_labels,
                  datasets: [{
                    backgroundColor: chart_backgroundColor,
                    data: chart_values
                  }]
                }
              });
        };
    
        // Make sure you run this code under Elementor.
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/mt-piedoughnutchart.default', WidgetPieDoughnutChartHandler);
        });
    })(jQuery);
