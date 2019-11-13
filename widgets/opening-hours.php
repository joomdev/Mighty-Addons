<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_OpeningHours
 *
 * Elementor widget for MT_OpeningHours.
 *
 * @since 1.0.0
 */
class MT_OpeningHours extends Widget_Base {
	
	public function get_name() {
		return 'mt-openinghours';
	}
	
	public function get_title() {
		return __( 'MT Opening Hours', 'mighty' );
	}
	
	public function get_icon() {
		return 'fas fa-clock';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_style_depends() {
		return [ 'mt-common', 'mt-openinghours' ];
    }
	
	protected function _register_controls() {

        $this->start_controls_section(
			'section_openinghours',
			[
				'label' => __( 'MT Opening Hours', 'mighty' ),
			]
        );
        
            $repeater = new Repeater();

            $repeater->start_controls_tabs( 'business_days_timings' );

                $repeater->add_control(
                    'business_day',
                    [
                        'label' => __('Enter Day', 'mighty'),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Monday',
                    ]
                );

                $repeater->add_control(
                    'business_time',
                    [
                        'label' => __('Enter Time', 'mighty'),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Always Open',
                    ]
                );

                $repeater->add_control(
                    'enable_styling',
                    [
                        'label' => __( 'Enable Styling', 'mighty' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'On', 'mighty' ),
                        'label_off' => __( 'Off', 'mighty' ),
                        'return_value' => 'true',
                        'default' => 'true',
                    ]
                );

                $repeater->add_control(
                    'day_color',
                    [
                        'label' => __( 'Day Color', 'mighty' ),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}}' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_styling' => 'true',
                        ],
                    ]
                );

                $repeater->add_control(
                    'time_color',
                    [
                        'label' => __( 'Time Color', 'mighty' ),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}}' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_styling' => 'true',
                        ],
                    ]
                );

                $repeater->add_control(
                    'oh_bg_color',
                    [
                        'label' => __( 'Background Color', 'mighty' ),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}}' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_styling' => 'true',
                        ],
                    ]
                );

                $this->add_control(
                    'mt_openinghours_data',
                    [
                        'label' => __('Business Days & Timings', 'mighty'),
                        'type' => Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                            [
                                'business_day' => __('Monday', 'mighty'),
                                'business_time' => __('10 AM - 5 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Tuesday', 'mighty'),
                                'business_time' => __('10 AM - 5 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Wednesday', 'mighty'),
                                'business_time' => __('10 AM - 5 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Thursday', 'mighty'),
                                'business_time' => __('10 AM - 5 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Friday', 'mighty'),
                                'business_time' => __('10 AM - 5 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Saturday', 'mighty'),
                                'business_time' => __('Closed', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#bb0f0f',
                                'time_color' => '#bb0f0f',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Sunday', 'mighty'),
                                'business_time' => __('Closed', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#bb0f0f',
                                'time_color' => '#bb0f0f',
                                'oh_bg_color' => '#fff',
                            ],
                        ],
                        'title_field' => '{{{ business_day }}}',
                    ]
                );
			
            $repeater->end_controls_tabs();

            $this->add_control(
                'footer_text',
                [
                    'label' => __('Footer Text', 'mighty'),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Come in we\'re open!',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'opening_hours_styling',
			[
				'label' => __( 'Opening Hours Styling', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'row_spacing',
                [
                    'label' => __( 'Row Spacing', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'divider_styling',
			[
				'label' => __( 'Divider', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'enable_divider',
                [
                    'label' => __( 'Divider', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'true',
                    'default' => 'true',
                ]
            );

            $this->add_control(
                'divider_style',
                [
                    'label' => __( 'Style', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        'solid'  => __( 'Solid', 'mighty' ),
                        'dotted' => __( 'Dotted', 'mighty' ),
                        'dashed' => __( 'Dashed', 'mighty' ),
                    ],
                    'condition' => [
                        'enable_divider' => 'true',
                    ],
                ]
            );

            $this->add_control(
                'divider_color',
                [
                    'label' => __( 'Divider Color', 'mighty' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}}' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'enable_divider' => 'true',
                    ],
                ]
            );

            $this->add_control(
                'divider_weight',
                [
                    'label' => __( 'Weight', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 20,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'border: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'day_time_styling',
			[
				'label' => __( 'Day & Time', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'day_alignment',
                [
                    'label' => __( 'Day Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' => "text-align: {{VALUE}}",
                    ]
                ]
            );

            $this->add_control(
                'time_alignment',
                [
                    'label' => __( 'Time Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' => "text-align: {{VALUE}}",
                    ]
                ]
            );

            $this->add_control(
                'oh_day_color',
                [
                    'label' => __( 'Day Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'day_typography',
                    'label' => __( 'Day Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} ',
                ]
            );

            $this->add_control(
                'oh_time_color',
                [
                    'label' => __( 'Time Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'time_typography',
                    'label' => __( 'Time Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} ',
                ]
            );

            $this->add_control(
                'striped_effect',
                [
                    'label' => __( 'Striped Effect', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'true',
                    'default' => 'true',
                ]
            );

            $this->add_control(
                'odd_rows_bg_color',
                [
                    'label' => __( 'Odd Rows Background', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'striped_effect' => 'true',
                    ],
                ]
            );

            $this->add_control(
                'even_rows_bg_color',
                [
                    'label' => __( 'Even Rows Background', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'striped_effect' => 'true',
                    ],
                ]
            );


        $this->end_controls_section();
        
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings[ 'mt_openinghours_data'] ) ) {
            return;
		}
        ?>
        <div class="ma-openinghours-wrapper">

            <div class="ma-oh-header">
                <h2>Opening Hours</h2>
            </div>

            <div class="ma-oh-rows">
                <div class="ma-oh-row">
                    <div class="ma-oh-day">Monday</div>
                    <div class="ma-oh-time">10:00-05:00</div>
                </div>
                <div class="ma-oh-row">
                    <div class="ma-oh-day">Tuesday</div>
                    <div class="ma-oh-time">10:00-05:00</div>
                </div>
            </div>

            <div class="ma-oh-footer">
                <p>Office is open 24 hours</p>
            </div>

        </div>
        <?php
	}
	
	protected function _content_template() {
	}
}
