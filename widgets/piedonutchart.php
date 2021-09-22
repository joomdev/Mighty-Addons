<?php

namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MT_piedonutchart extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		wp_register_script( 'mt-chart', MIGHTY_ADDONS_PLG_URL . 'assets/js/chart.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );
		wp_register_script( 'mt-piedonutchart', MIGHTY_ADDONS_PLG_URL . 'assets/js/piechart.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );
	}

	public function get_name() {
		return 'mt-piedonutchart';
	}

	public function get_title() {
		return __( 'Pie and Donut Chart', 'mighty' );
    }
    
	public function get_icon() {
		return 'mf mf-piedonutchart';
    }

    public function get_categories() {
        return [ 'mighty-addons' ];
    }

    public function get_script_depends() {
        return [
            'mt-chart',
            'mt-piedonutchart'
        ];
    }

    public function get_style_depends() {
		return [ 'mt-common' ];
    }
    
	public function get_keywords() {
		return [ 'mighty', 'mt', 'chart', 'graph', 'product' ];
    }
    
	protected function register_controls() {
        // basic section
		$this->start_controls_section(
			'section_mpdc_basic',
			[
				'label' => __( 'Basic', 'mighty' ),
			]
		);

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'data_label',
                [
                    'label' => __('Data Label', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                ]
            );

            $repeater->add_control(
                'data_value', [
                    'label' => __( 'Data Value', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'background_image',
                [
                    'label' => __( 'Background Image', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater->add_control(
                'background_color', [
                    'label' => __( 'Background Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => __( 'red' , 'mighty' ),
                ]
            );

            $repeater->add_control(
                'background_hover_color', [
                    'label' => __( 'Background Hover Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => __( 'red' , 'mighty' ),
                ]
            );

            $repeater->add_control(
                'border_color', [
                    'label' => __( 'Border Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                ]
            );

            $repeater->add_control(
                'border_hover_color', [
                    'label' => __( 'Border Hover Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                ]
            );

            $this->add_control(
                'data_list',
                [
                    'label' => __( 'Data Sets', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        
                            'data_value' => __( '30', 'mighty' ),
                            'data_label' => __( 'Label 1' ),
                            'background_color' => __( 'red', 'mighty' ),
                            'background_hover_color' => __( 'blue', 'mighty' ),
                            'background_image' => __( '', 'mighty' ),
                            'border_color' => __( 'red', 'mighty' ),
                            'border_hover_color' => __( 'blue', 'mighty' ),
                    ],
                    'title_field' => 'Data Values',
                ]
            );

            $this->add_control(
                'chart_title',
                [
                    'label' => __('Title', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                ]
            );

            $this->add_control(
                'chart_description',
                [
                    'label' => __('Description', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                ]
            );

        $this->end_controls_section();
        // style 
        $this->start_controls_section(
			'section_cg_style',
			[
				'label' => __( 'Basic', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'chart_alignment',
                [
                    'label' => __( 'Chart Alignment', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Start', 'mighty' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'End', 'mighty' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                ]
            );

            
            $this->add_control(
                'chart_type',
                [
                    'label' => __('Chart Type', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => __('pie'),
                    'options' => [
                        'pie' => __('Pie', 'mighty'),
                        'doughnut' => __('Donut', 'mighty'),
                    ],
                ]
            );

            $this->add_responsive_control(
                'chart_width',
                [
                    'label' => __( 'Chart Width', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 1000
                        ]
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-chart' => 'width: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );


            $this->add_control(
                'chart_aspect_ratio',
                [
                    'label' => __( 'Chart Aspect Ratio', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%' , 'px' , 'EM' ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 10,
                            'step' => 0.5,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 1,
                    ],
                ]
            );

            $this->add_control(
                'chart_border_width',
                [
                    'label' => __( 'Border Width', 'mighty' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '2',

                ]
            );

            $this->add_control(
                'chart_hover_border_width',
                [
                    'label' => __( 'Hover Border Width', 'mighty' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '2',

                ]
            );

        $this->end_controls_section();

        // content
        $this->start_controls_section(
			'section_cg_tick_style',
			[
				'label' => __( 'Content', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'text_alignment',
                [
                    'label' => __( 'Text Alignment', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'left', 'mighty' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'right', 'mighty' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mighty-chart .chart-text' => "text-align: {{VALUE}}",
                    ]
                ]
            );

            $this->add_control(
                'title_html_tag',
                [
                    'label' => __( 'Title HTML Tag', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'H5' => __('Default', 'mighty'),
                        'h1' => __('H1', 'mighty'),
                        'h2' => __('H2', 'mighty'),
                        'h3' => __('H3', 'mighty'),
                        'h4' => __('H4', 'mighty'),
                        'h5' => __('H5', 'mighty'),
                        'h6' => __('H6', 'mighty'),
                        'p' => __('P', 'mighty'),
                    ],
                    'default' => 'h5',
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Title Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => 'grey',
                    'selectors' => [
                        '{{WRAPPER}} .mighty-chart .chart-title' => "color: {{VALUE}}",
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => __('Title Typography', 'mighty'),
                    'selector' => '{{WRAPPER}} .mighty-chart .chart-title',
                ]
            );

            $this->add_control(
                'background_color',
                [
                    'label' => __( 'Description Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => 'grey',
                    'selectors' => [
                        '{{WRAPPER}} .mighty-chart .chart-desc' => "color: {{VALUE}}",
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'label' => __('Description Typography', 'mighty'),
                    'selector' => '{{WRAPPER}} .mighty-chart .chart-desc',
                ]
            );

            $this->add_responsive_control(
                'space_between_chart_content',
                [
                    'label' => __( 'Space Between Chart & Content', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-chart .chart-text' => "margin-top: {{SIZE}}{{UNIT}}",
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_between_title_description',
                [
                    'label' => __( 'Space Between Title & Description', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-chart .chart-desc' => "margin-top: {{SIZE}}{{UNIT}}",
                    ]
                ]
            );

        $this->end_controls_section();

        // legend
        $this->start_controls_section(
			'section_cg_legend_style',
			[
				'label' => __( 'Legend', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'enable_chart_legend', [
                    'label' => __( 'Chart Legend', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'legend_position',
                [
                    'label' => __( 'Position', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'top' => [
                            'title' => __( 'top', 'mighty' ),
                            'icon' => 'fa fa-sort-up',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'fa fa-align-right',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'mighty' ),
                            'icon' => 'fa fa-sort-down',
                        ],
                    ],
                    'default' => 'top',
                    'toggle' => true,
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'legend_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'start' => __('Start', 'mighty'),
                        'center' => __('Center', 'mighty'),
                        'end' => __('End', 'mighty'),
                    ],
                    'default' => 'center',
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'legend_bar_width',
                [
                    'label' => __( 'Bar Width', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 40,
                    ],
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'legend_bar_height',
                [
                    'label' => __( 'Bar Height', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 0.1,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 10,
                    ],
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'space_between_legend',
                [
                    'label' => __( 'Space Between Legends', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 20,
                    ],
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'legend_label_color',
                [
                    'label' => __( 'Label Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => 'grey',
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'legend_label_font',
                [
                    'label' => __( 'Label Font', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::FONT,
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'legend_label_font_size',
                [
                    'label' => __( 'Font Size', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SLIDER ,
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ],
                    'size_units' => [ '%' ],
                    'range' => [
                        '%' => [
                            'min' => 10,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 10,
                    ],
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'legend_font_weight',
                [
                    'label' => __( 'Font weight', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '100' => __('100', 'mighty'),
                        '200' => __('200', 'mighty'),
                        '300' => __('300', 'mighty'),
                        '400' => __('400', 'mighty'),
                        '500' => __('500', 'mighty'),
                        '600' => __('600', 'mighty'),
                        '700' => __('700', 'mighty'),
                        '800' => __('800', 'mighty'),
                        '900' => __('900', 'mighty'),
                        'default' => __('Default', 'mighty'),
                        'normal' => __('Normal', 'mighty'),
                        'bold' => __('Bold', 'mighty'),
                    ],
                    'default' => 'normal',
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ]
                ]
            );


        $this->end_controls_section();

    }
    
	protected function render() {
        
        $settings = $this->get_settings_for_display();
        // print_r(wp_get_attachment_image_src( $settings['background_image'], 'full' )[0]);
        // print_r($settings['background_image']);
        $label = [];
        $values = [];
        $backgroundColor = [];
        $borderColor = [];
        $hoverBorderColor = [];
        $hoverBackgroundColor = [];
        $backgroundImage = [];
        
        foreach ($settings['data_list'] as $key => $value) {
            array_push($label, $value['data_label']);
            array_push($values, $value['data_value']);
            array_push($borderColor, $value['border_color']);
            array_push($hoverBorderColor, $value['border_hover_color']);
            array_push($backgroundColor, $value['background_color']);
            array_push($backgroundImage, $value['background_image']['url']);
            
        }
        if( $settings['chart_alignment'] == 'left' ){

            $this->add_render_attribute( 'mighty-chart-position', 'class', 'mt-chart-left' );

            } elseif( $settings['chart_alignment'] == 'right' ){
                
            $this->add_render_attribute( 'mighty-chart-position', 'class', 'mt-chart-right' );
            
        } else {

            $this->add_render_attribute( 'mighty-chart-position', 'class', 'mt-chart-center' );
            
        }
        $this->add_render_attribute( 'mighty-chart-position', 'class', 'mighty-chart' );

        $this->add_render_attribute( 'mighty-chart', 'id', 'canvas' );
        $this->add_render_attribute( 'chart_title', 'class', 'chart-title' );
        $this->add_render_attribute( 'mighty-chart', 'data-label', json_encode($label) );
        $this->add_render_attribute( 'mighty-chart', 'data-values', json_encode($values) );
        $this->add_render_attribute( 'mighty-chart', 'data-borderColor', json_encode($borderColor) );
        $this->add_render_attribute( 'mighty-chart', 'data-hoverBorderColor', json_encode($hoverBorderColor) );
        $this->add_render_attribute( 'mighty-chart', 'data-backgroundColor', json_encode($backgroundColor) );
        $this->add_render_attribute( 'mighty-chart', 'data-backgroundImage', json_encode($backgroundImage) );
        $this->add_render_attribute( 'mighty-chart', 'data-hoverBackgroundColor', json_encode($hoverBackgroundColor) );
        $this->add_render_attribute( 'mighty-chart', 'data-type', $settings['chart_type'] );
        $this->add_render_attribute( 'mighty-chart', 'data-borderWidth', $settings['chart_border_width'] );
        $this->add_render_attribute( 'mighty-chart', 'data-borderHoverWidth', $settings['chart_hover_border_width'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_style', $settings['enable_chart_legend'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_position', $settings['legend_position'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_alignment', $settings['legend_alignment'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_bar_height', isset($settings['legend_bar_height']) ? $settings['legend_bar_height']['size'] : '' );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_bar_width', isset($settings['legend_bar_width']) ? $settings['legend_bar_width']['size'] : '' );
        $this->add_render_attribute( 'mighty-chart', 'data-space_between_legend', isset($settings['space_between_legend']) ? $settings['space_between_legend']['size'] : '' );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_label_font_size', isset($settings['legend_label_font_size']) ? $settings['legend_label_font_size']['size'] : '' );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_label_color', $settings['legend_label_color'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_label_font', $settings['legend_label_font'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_font_weight', $settings['legend_font_weight'] );
        $this->add_render_attribute( 'mighty-chart', 'data-aspect_ratio', isset($settings['chart_aspect_ratio']) ? $settings['chart_aspect_ratio']['size'] : '' );
        ?>
        <?php echo '<div '.$this->get_render_attribute_string('mighty-chart-position').'  id="mt-chart-' . $this->get_id() . '" >' ?>

        <canvas <?php echo $this->get_render_attribute_string('mighty-chart'); ?> ></canvas>
        <div class="chart-text">
            <<?php echo $settings['title_html_tag'];?> <?php echo $this->get_render_attribute_string('chart_title');?>><?php echo $settings['chart_title']; ?></<?php echo $settings['title_html_tag'];?>>
            <p class="chart-desc"><?php echo $settings['chart_description']; ?></p>
        </div>
        <?php echo '</div>'; ?>

    <?php

	}
}
