(function ($) {
    var WidgetPieDonutChartHandler = function ( $scope, $ ) {

        var chart =                      $scope.find( 'canvas' );        
        let chart_labels =               chart.attr( "data-label" );
        let chart_values =               chart.attr( "data-values" );
        let chart_backgroundColor =      chart.attr( "data-backgroundColor" );
        let chart_hoverBackgroundColor = chart.attr("data-hoverBackgroundColor");
        let chart_borderColor =          chart.attr("data-borderColor");
        let chart_hoverBorderColor =     chart.attr("data-hoverBorderColor");
        let chart_type =                 chart.attr("data-type");
        let borderWidth =                chart.attr("data-borderWidth");
        let borderHoverWidth =           chart.attr("data-borderHoverWidth");
        let legend_style =               chart.attr("data-legend_style");
        let legend_position =            chart.attr("data-legend_position");
        let legend_alignment =           chart.attr("data-legend_alignment");
        let legend_bar_width =           chart.attr("data-legend_bar_width");
        let space_between_legend =       chart.attr("data-space_between_legend");
        let legend_label_color =         chart.attr("data-legend_label_color");
        let legend_bar_height =          chart.attr("data-legend_bar_height");
        let legend_label_font =          chart.attr("data-legend_label_font");
        let legend_label_font_size =     chart.attr("data-legend_label_font_size");
        let legend_font_weight =     chart.attr("data-legend_font_weight");
        var legend_display = (legend_style == 'yes') ? true : false;
        var myChart = new Chart(chart, {
            type: chart_type,
            data: {
              labels: JSON.parse(chart_labels),
                datasets: [{
                    backgroundColor: JSON.parse(chart_backgroundColor),
                    hoverBackgroundColor: JSON.parse(chart_hoverBackgroundColor),
                    borderColor: JSON.parse(chart_borderColor),
                    hoverBorderColor: JSON.parse(chart_hoverBorderColor),
                    data: JSON.parse(chart_values),
                    background : {
                        url : ['http://mighty.test/wp-content/uploads/2021/09/team-2.png'],
                    },

                }],
            },
            options : {
                elements: {
                  arc: {
                    borderWidth: borderWidth, 
                    hoverBorderWidth : borderHoverWidth
                  }
                },
                plugins: {
                    legend: {
                      display: legend_display,
                      labels: {
                        boxWidth: parseInt(legend_bar_width),
                        boxHeight: parseInt(legend_bar_height),
                        color: legend_label_color,
                        padding: parseInt(space_between_legend),
                        font: {
                          family: legend_label_font,
                          size: legend_label_font_size,
                          weight : legend_font_weight
                        },
                      },
                        position: legend_position,
                        align: legend_alignment,
                    }
          
                }
            },
            
        });
    };
    
        // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/mt-piedonutchart.default', WidgetPieDonutChartHandler);
    });
})(jQuery);
