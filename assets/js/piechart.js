(function ($) {
    var WidgetPieDonutChartHandler = function ( $scope, $ ) {
        var chart =                      $scope.find( 'canvas' );        
        let chart_labels =               chart.attr( "data-label" );
        let chart_values =               chart.attr( "data-values" );
        let chart_backgroundColor =      chart.attr( "data-backgroundColor" );
        chart_backgroundColor =          JSON.parse(chart_backgroundColor);
        let chart_hoverBackgroundColor = chart.attr("data-hoverBackgroundColor");
        chart_hoverBackgroundColor =     JSON.parse(chart_hoverBackgroundColor);
        console.log(chart_hoverBackgroundColor);
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
        let legend_font_weight =         chart.attr("data-legend_font_weight");
        let aspect_ratio =               chart.attr("data-aspect_ratio");
        let background_image =           chart.attr("data-backgroundImage");
        background_image = JSON.parse(background_image);
        let hasPatternImages = false;
        var chart1;

        var legend_display = (legend_style == 'yes') ? true : false;

        var myChart = {
            type: chart_type,
            data: {
              labels: JSON.parse(chart_labels),
                datasets: [{
                    pattern: background_image,
                    backgroundColor: chart_backgroundColor,
                    hoverBackgroundColor: chart_hoverBackgroundColor,
                    borderColor: JSON.parse(chart_borderColor),
                    hoverBorderColor: JSON.parse(chart_hoverBorderColor),
                    data: JSON.parse(chart_values),
                    borderWidth: borderWidth, 
                    hoverBorderWidth : borderHoverWidth,
                }],
            },
            options : {
              aspectRatio : aspect_ratio,
              responsive: true,
              animation: {
                animateScale: true,
                animateRotate: true
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
      };

        background_image.forEach(
          function ( item, index ) {

            if ( item ) {
              hasPatternImages = true;
              var img          = new Image();
              img.src          = background_image[index];
              
              img.onload = function () {
                var ctx                      = document.getElementById('canvas').getContext('2d');
                var fillPattern              = ctx.createPattern(
                  img,
                  'repeat'
                );
                chart_backgroundColor[index]      = fillPattern;
                chart_hoverBackgroundColor[index] = fillPattern;
  
                chart1 = new Chart(
                  ctx,
                  myChart
                );
              };
            }
          }
        );
      	if ( ! hasPatternImages ) {
          ctx = document.getElementById('canvas');
  
          chart1 = new Chart(
            ctx,
            myChart
          );
        }
    };
    
        // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/mt-piedonutchart.default', WidgetPieDonutChartHandler);
    });
})(jQuery);
