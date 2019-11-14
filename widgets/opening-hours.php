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
		return 'mf mf-openinghours';
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
                        'default' => '#000',
                        'selectors' => [
                            '{{WRAPPER}} .ma-openinghours-wrapper {{CURRENT_ITEM}} .ma-oh-day' => 'color: {{VALUE}}',
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
                        'default' => '#000',
                        'selectors' => [
                            '{{WRAPPER}} .ma-openinghours-wrapper {{CURRENT_ITEM}} .ma-oh-time' => 'color: {{VALUE}}',
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
                            '{{WRAPPER}} .ma-openinghours-wrapper {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
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
                'header_text',
                [
                    'label' => __('Header', 'mighty'),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Opening Hours',
                ]
            );

            $this->add_control(
                'footer_text',
                [
                    'label' => __('Footer', 'mighty'),
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
                    'default' => [
                        'top' => '10',
                        'right' => '10',
                        'bottom' => '10',
                        'left' => '10',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'default' => 'dashed',
                    'options' => [
                        'solid'  => __( 'Solid', 'mighty' ),
                        'dotted' => __( 'Dotted', 'mighty' ),
                        'dashed' => __( 'Dashed', 'mighty' ),
                    ],
                    'condition' => [
                        'enable_divider' => 'true',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-row:not(:last-child)' => 'border-bottom-style: {{VALUE}};',
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
                    'default' => '#d3d3d3',
                    'selectors' => [
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-row:not(:last-child)' => 'border-bottom-color: {{VALUE}};',
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
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-row:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'enable_divider' => 'true',
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
                    'default' => 'left',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-day' => "text-align: {{VALUE}}",
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
                    'default' => 'right',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-time' => "text-align: {{VALUE}}",
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
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-day' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'day_typography',
                    'label' => __( 'Day Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-day',
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
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-time' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'time_typography',
                    'label' => __( 'Time Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-time',
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
                    'default' => 'false',
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
                    'default' => '#fff',
                    'selectors' => [
                        '.ma-openinghours-wrapper .ma-oh-row.mt-striped:nth-child(odd)' => 'background: {{VALUE}}',
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
                    'default' => '#f7f7f7',
                    'selectors' => [
                        '.ma-openinghours-wrapper .ma-oh-row.mt-striped:nth-child(even)' => 'background: {{VALUE}}',
                    ],
                    'condition' => [
                        'striped_effect' => 'true',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'header_text_styling',
			[
				'label' => __( 'Header Styling', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'header_text!' => ''
				],
			]
        );

            $this->add_control(
                'oh_header_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-oh-header' => 'color: {{VALUES}}'
                    ],
                    'default' => '#fff',
                ]
            );

            $this->add_control(
                'oh_header_bgcolor',
                [
                    'label'     => __( 'Background Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-oh-header' => 'background-color: {{VALUES}}'
                    ],
                    'default' => '#000',
                ]
            );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'oh_header_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .ma-oh-header',
				]
            );

            $this->add_control(
                'oh_header_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'oh_header_margin',
                [
                    'label' => __( 'Margin', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'footer_text_styling',
			[
				'label' => __( 'Footer Styling', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'footer_text!' => ''
				],
			]
        );

            $this->add_control(
                'oh_footer_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-oh-footer' => 'color: {{VALUES}}'
                    ],
                    'default' => '#000',
                ]
            );

            $this->add_control(
                'oh_footer_bgcolor',
                [
                    'label'     => __( 'Background Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-oh-footer' => 'background-color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'oh_footer_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ma-oh-footer',
                ]
            );

            $this->add_control(
                'oh_footer_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'oh_footer_margin',
                [
                    'label' => __( 'Margin', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-openinghours-wrapper .ma-oh-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

            <div class="ma-oh-header"><?php echo $settings['header_text']; ?></div>

            <div class="ma-oh-rows">
                <?php foreach (  $settings['mt_openinghours_data'] as $item ) : ?>
                <div class="ma-oh-row <?php echo ($settings['striped_effect'] == true) ? 'mt-striped' : ''; ?> elementor-repeater-item-<?php echo $item['_id']; ?>">
                    <div class="ma-oh-day"><?php echo $item['business_day']; ?></div>
                    <div class="ma-oh-time"><?php echo $item['business_time']; ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="ma-oh-footer"><?php echo $settings['footer_text']; ?></div>

        </div>
        <?php
	}
	
	protected function _content_template() {
	}
}
