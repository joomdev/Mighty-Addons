<?php

namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MT_piedoughnutchart extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		wp_register_script( 'mightypro-piedoughnutchart', MIGHTY_ADDONS_PLG_URL . 'assets/js/piechart.js', [ 'jquery' ], MIGHTY_ADDONS_PRO_VERSION, true );
	}

	public function get_name() {
		return 'mt-piedoughnutchart';
	}

	public function get_title() {
		return __( 'Pie and Doughnut Chart', 'mighty' );
    }
    
	public function get_icon() {
		return 'mf mf-piedoughnutchart';
    }

    public function get_categories() {
        return [ 'mighty-addons' ];
    }

    public function get_script_depends() {
        return [
            'mighty-main',
            'mighty-chart'
        ];
    }
    
	public function get_keywords() {
		return [ 'mighty', 'mt', 'chart', 'graph', 'product' ];
    }
    
	protected function _register_controls() {
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
                    // 'default' => __('2019'),
                ]
            );

            $repeater->add_control(
                'data_value', [
                    'label' => __( 'Data Value', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'label_block' => true,
                    // 'default' => __( '30' , 'mighty' ),
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
                            'background_image' => __( ' ', 'mighty' ),
                            'border_color' => __( 'red', 'mighty' ),
                            'border_hover_color' => __( 'blue', 'mighty' ),
                    ],
                    'title_field' => 'Data Values',
                ]
            );

        $this->end_controls_section();
        // style 
        $this->start_controls_section(
			'section_cg_style',
			[
				'label' => __( 'Chart', 'mighty' ),
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

            $this->add_responsive_control(
                'graph_size',
                [
                    'label' => __( 'Graph Size', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' ],
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
                        'size' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-chart' => 'width: {{SIZE}}{{UNIT}};',
                    ]
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
                        'doughnut' => __('Doughnut', 'mighty'),
                    ],
                ]
            );

            $this->add_control(
                'chart_width',
                [
                    'label' => __( 'Chart Width', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.05,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0.9,
                    ],
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
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
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
                ]
            );

            $this->add_control(
                'title_html_tag',
                [
                    'label' => __( 'Title HTML Tag', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'default' => __('Default', 'mighty'),
                        'heading' => __('H1-H6', 'mighty'),
                        'paragraph' => __('P', 'mighty'),
                    ],
                    'default' => 'center',
                    'condition' => [
                        'enable_chart_legend' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Title Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => 'grey'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => __('Title Typography', 'mighty'),
                    'selector' => '{{WRAPPER}} .mt-woo-product-title a',
                ]
            );

            $this->add_control(
                'background_color',
                [
                    'label' => __( 'Background Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => 'grey'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'label' => __('Description Typography', 'mighty'),
                    'selector' => '{{WRAPPER}} .mt-woo-product-title a',
                ]
            );

            $this->add_control(
                'space_between_chart_content',
                [
                    'label' => __( 'Space Between Chart & Content', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.05,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0.9,
                    ],
                ]
            );

            $this->add_control(
                'space_between_title_description',
                [
                    'label' => __( 'Space Between Title & Description', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.05,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0.9,
                    ],
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
                    'label' => __( 'Enable Chart Legend', 'mighty' ),
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
                ]
            );

            $this->add_control(
                'legend_label_color',
                [
                    'label' => __( 'Label Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => 'grey'
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
                ]
            );

        $this->end_controls_section();

    }
    
	protected function render() {
        
        $settings = $this->get_settings_for_display();

        $data_values = [];
        
        foreach ($settings['data_list'] as $key => $value) {

            $data = array(

                'label' => $value['data_label'],
                'data' => $value['data_value'],
                'borderColor' => $value['border_color'],
                'hoverBorderColor' => $value['border_hover_color'],
                // 'fill'=>$value['filling_modes'],
                'backgroundColor' => $value['background_color'],
                'hoverBackgroundColor' => $value['background_hover_color'],
                // 'borderWidth'=> $settings['graph_border_width'],
                // 'hoverBorderWidth'=> $settings['bar_border_hover_width'],
                // 'barPercentage' => ( isset($settings['bar_size']['size']) ) ? $settings['bar_size']['size'] : '' ,
                // 'categoryPercentage' => ( isset($settings['category_size']['size']) ) ? $settings['category_size']['size'] : ''
                
            );

            array_push($data_values,$data);
        }

        print_r($data_values);


        if( $settings['graph_alignment'] == 'left' ){

            $this->add_render_attribute( 'mighty-chart-position', 'class', 'mt_chart_left' );

            } elseif( $settings['graph_alignment'] == 'right' ){
                
            $this->add_render_attribute( 'mighty-chart-position', 'class', 'mt_chart_right' );
            
        } else {

            $this->add_render_attribute( 'mighty-chart-position', 'class', 'mt_chart_center' );
            
        }
        $this->add_render_attribute( 'mighty-chart-position', 'class', 'mighty-chart' );

        $this->add_render_attribute( 'mighty-chart', 'data-label', $settings['data_label'] );
        $this->add_render_attribute( 'mighty-chart', 'data-type', $settings['graph_type'] );
        $this->add_render_attribute( 'mighty-chart', 'data-chart_data', json_encode($data_values) );
        $this->add_render_attribute( 'mighty-chart', 'data-max_value', $settings['maximum_data_value'] );
        $this->add_render_attribute( 'mighty-chart', 'data-min_value', $settings['minimum_data_value'] );
        $this->add_render_attribute( 'mighty-chart', 'data-step_value', $settings['step_size'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_style', $settings['enable_chart_legend'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_position', $settings['legend_position'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_alignment', $settings['legend_alignment'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_bar_height', $settings['legend_bar_height']['size'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_bar_width', $settings['legend_bar_width']['size'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_bar_margin', $settings['legend_bar_margin']['size'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_label_color', $settings['legend_label_color'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_label_font', $settings['legend_label_font'] );
        $this->add_render_attribute( 'mighty-chart', 'data-legend_label_font_size', $settings['legend_label_font_size']['size'] );
        ?>
        <?php echo '<div '.$this->get_render_attribute_string('mighty-chart-position').'  id="mighty-chart-' . $this->get_id() . '" >' ?>

        <canvas <?php echo $this->get_render_attribute_string('mighty-chart'); ?> ></canvas>

        <?php echo '</div>'; ?>

    <?php

	}
}
