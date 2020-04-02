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
class MT_Openinghours extends Widget_Base {
	
	public function get_name() {
		return 'mt-openinghours';
	}
	
	public function get_title() {
		return __( 'Opening Hours', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-openinghours';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
    }
    
    public function get_keywords() {
		return [ 'mighty', 'opening', 'hours', 'info' ];
    }

	public function get_style_depends() {
		return [ 'mt-common', 'mt-openinghours' ];
    }
	
	protected function _register_controls() {

        $this->start_controls_section(
			'section_openinghours',
			[
				'label' => __( 'Opening Hours', 'mighty' ),
			]
        );
        
            $repeater = new Repeater();

            $repeater->start_controls_tabs( 'business_days_timings' );

                $repeater->add_control(
                    'business_day',
                    [
                        'label' => __('Select Day', 'mighty'),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'Monday',
                        'options' => [
                            'All Days'  => __( 'All Days', 'mighty' ),
                            'Monday - Friday'  => __( 'Monday - Friday', 'mighty' ),
                            'Saturday - Sunday'  => __( 'Saturday - Sunday', 'mighty' ),
                            'Monday'  => __( 'Monday', 'mighty' ),
                            'Tuesday' => __( 'Tuesday', 'mighty' ),
                            'Wednesday' => __( 'Wednesday', 'mighty' ),
                            'Thursday' => __( 'Thursday', 'mighty' ),
                            'Friday' => __( 'Friday', 'mighty' ),
                            'Saturday' => __( 'Saturday', 'mighty' ),
                            'Sunday' => __( 'Sunday', 'mighty' ),
                        ],
                    ]
                );

                $repeater->add_control(
                    'opening_business_time',
                    [
                        'label' => __('Opening Time', 'mighty'),
                        'type' => Controls_Manager::SELECT,
                        'default' => '24 hours',
                        'options' => [
                            'Closed' =>      __( 'Closed', 'mighty' ),
                            '24 hours' =>    __( '24 hours', 'mighty' ),
                            '12:00 AM' =>    __( '12:00 AM', 'mighty' ),
                            '12:30 AM' =>    __( '12:30 AM', 'mighty' ),
                            '1:00 AM' =>     __( '1:00 AM', 'mighty' ),
                            '1:30 AM' =>     __( '1:30 AM', 'mighty' ),
                            '2:00 AM' =>     __( '2:00 AM', 'mighty' ),
                            '2:30 AM' =>     __( '2:30 AM', 'mighty' ),
                            '3:00 AM' =>     __( '3:00 AM', 'mighty' ),
                            '3:30 AM' =>     __( '3:30 AM', 'mighty' ),
                            '4:00 AM' =>     __( '4:00 AM', 'mighty' ),
                            '4:30 AM' =>     __( '4:30 AM', 'mighty' ),
                            '5:00 AM' =>     __( '5:00 AM', 'mighty' ),
                            '5:30 AM' =>     __( '5:30 AM', 'mighty' ),
                            '6:00 AM' =>     __( '6:00 AM', 'mighty' ),
                            '6:30 AM' =>     __( '6:30 AM', 'mighty' ),
                            '7:00 AM' =>     __( '7:00 AM', 'mighty' ),
                            '7:30 AM' =>     __( '7:30 AM', 'mighty' ),
                            '8:00 AM' =>     __( '8:00 AM', 'mighty' ),
                            '8:30 AM' =>     __( '8:30 AM', 'mighty' ),
                            '9:00 AM' =>     __( '9:00 AM', 'mighty' ),
                            '9:30 AM' =>     __( '9:30 AM', 'mighty' ),
                            '10:00 AM' =>    __( '10:00 AM', 'mighty' ),
                            '10:30 AM' =>    __( '10:30 AM', 'mighty' ),
                            '11:00 AM' =>    __( '11:00 AM', 'mighty' ),
                            '11:30 AM' =>    __( '11:30 AM', 'mighty' ),
                            '12:00 PM' =>    __( '12:00 PM', 'mighty' ),
                            '12:30 PM' =>    __( '12:30 PM', 'mighty' ),
                            '1:00 PM' =>     __( '1:00 PM', 'mighty' ),
                            '1:30 PM' =>     __( '1:30 PM', 'mighty' ),
                            '2:00 PM' =>     __( '2:00 PM', 'mighty' ),
                            '2:30 PM' =>     __( '2:30 PM', 'mighty' ),
                            '3:00 PM' =>     __( '3:00 PM', 'mighty' ),
                            '3:30 PM' =>     __( '3:30 PM', 'mighty' ),
                            '4:00 PM' =>     __( '4:00 PM', 'mighty' ),
                            '4:30 PM' =>     __( '4:30 PM', 'mighty' ),
                            '5:00 PM' =>     __( '5:00 PM', 'mighty' ),
                            '5:30 PM' =>     __( '5:30 PM', 'mighty' ),
                            '6:00 PM' =>     __( '6:00 PM', 'mighty' ),
                            '6:30 PM' =>     __( '6:30 PM', 'mighty' ),
                            '7:00 PM' =>     __( '7:00 PM', 'mighty' ),
                            '7:30 PM' =>     __( '7:30 PM', 'mighty' ),
                            '8:00 PM' =>     __( '8:00 PM', 'mighty' ),
                            '8:30 PM' =>     __( '8:30 PM', 'mighty' ),
                            '9:00 PM' =>     __( '9:00 PM', 'mighty' ),
                            '9:30 PM' =>     __( '9:30 PM', 'mighty' ),
                            '10:00 PM' =>    __( '10:00 PM', 'mighty' ),
                            '10:30 PM' =>    __( '10:30 PM', 'mighty' ),
                            '11:00 PM' =>    __( '11:00 PM', 'mighty' ),
                            '11:30 PM' =>    __( '11:30 PM', 'mighty' ),
                        ],
                    ]
                );

                $repeater->add_control(
                    'closing_business_time',
                    [
                        'label' => __('Closing Time', 'mighty'),
                        'type' => Controls_Manager::SELECT,
                        'default' => '5:00 PM',
                        'options' => [
                            '12:00 AM' =>    __( '12:00 AM', 'mighty' ),
                            '12:30 AM' =>    __( '12:30 AM', 'mighty' ),
                            '1:00 AM' =>     __( '1:00 AM', 'mighty' ),
                            '1:30 AM' =>     __( '1:30 AM', 'mighty' ),
                            '2:00 AM' =>     __( '2:00 AM', 'mighty' ),
                            '2:30 AM' =>     __( '2:30 AM', 'mighty' ),
                            '3:00 AM' =>     __( '3:00 AM', 'mighty' ),
                            '3:30 AM' =>     __( '3:30 AM', 'mighty' ),
                            '4:00 AM' =>     __( '4:00 AM', 'mighty' ),
                            '4:30 AM' =>     __( '4:30 AM', 'mighty' ),
                            '5:00 AM' =>     __( '5:00 AM', 'mighty' ),
                            '5:30 AM' =>     __( '5:30 AM', 'mighty' ),
                            '6:00 AM' =>     __( '6:00 AM', 'mighty' ),
                            '6:30 AM' =>     __( '6:30 AM', 'mighty' ),
                            '7:00 AM' =>     __( '7:00 AM', 'mighty' ),
                            '7:30 AM' =>     __( '7:30 AM', 'mighty' ),
                            '8:00 AM' =>     __( '8:00 AM', 'mighty' ),
                            '8:30 AM' =>     __( '8:30 AM', 'mighty' ),
                            '9:00 AM' =>     __( '9:00 AM', 'mighty' ),
                            '9:30 AM' =>     __( '9:30 AM', 'mighty' ),
                            '10:00 AM' =>    __( '10:00 AM', 'mighty' ),
                            '10:30 AM' =>    __( '10:30 AM', 'mighty' ),
                            '11:00 AM' =>    __( '11:00 AM', 'mighty' ),
                            '11:30 AM' =>    __( '11:30 AM', 'mighty' ),
                            '12:00 PM' =>    __( '12:00 PM', 'mighty' ),
                            '12:30 PM' =>    __( '12:30 PM', 'mighty' ),
                            '1:00 PM' =>     __( '1:00 PM', 'mighty' ),
                            '1:30 PM' =>     __( '1:30 PM', 'mighty' ),
                            '2:00 PM' =>     __( '2:00 PM', 'mighty' ),
                            '2:30 PM' =>     __( '2:30 PM', 'mighty' ),
                            '3:00 PM' =>     __( '3:00 PM', 'mighty' ),
                            '3:30 PM' =>     __( '3:30 PM', 'mighty' ),
                            '4:00 PM' =>     __( '4:00 PM', 'mighty' ),
                            '4:30 PM' =>     __( '4:30 PM', 'mighty' ),
                            '5:00 PM' =>     __( '5:00 PM', 'mighty' ),
                            '5:30 PM' =>     __( '5:30 PM', 'mighty' ),
                            '6:00 PM' =>     __( '6:00 PM', 'mighty' ),
                            '6:30 PM' =>     __( '6:30 PM', 'mighty' ),
                            '7:00 PM' =>     __( '7:00 PM', 'mighty' ),
                            '7:30 PM' =>     __( '7:30 PM', 'mighty' ),
                            '8:00 PM' =>     __( '8:00 PM', 'mighty' ),
                            '8:30 PM' =>     __( '8:30 PM', 'mighty' ),
                            '9:00 PM' =>     __( '9:00 PM', 'mighty' ),
                            '9:30 PM' =>     __( '9:30 PM', 'mighty' ),
                            '10:00 PM' =>    __( '10:00 PM', 'mighty' ),
                            '10:30 PM' =>    __( '10:30 PM', 'mighty' ),
                            '11:00 PM' =>    __( '11:00 PM', 'mighty' ),
                            '11:30 PM' =>    __( '11:30 PM', 'mighty' ),
                        ],
                        'condition' =>[
                            'opening_business_time!' => ['24 hours', 'Closed']
                        ]
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
                        'default' => '#232323',
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
                        'default' => '#232323',
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
                                'opening_business_time' => __('10:00 AM', 'mighty'),
                                'closing_business_time' => __('5:00 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Tuesday', 'mighty'),
                                'opening_business_time' => __('10:00 AM', 'mighty'),
                                'closing_business_time' => __('5:00 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Wednesday', 'mighty'),
                                'opening_business_time' => __('10:00 AM', 'mighty'),
                                'closing_business_time' => __('5:00 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Thursday', 'mighty'),
                                'opening_business_time' => __('10:00 AM', 'mighty'),
                                'closing_business_time' => __('5:00 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Friday', 'mighty'),
                                'opening_business_time' => __('10:00 AM', 'mighty'),
                                'closing_business_time' => __('5:00 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Saturday', 'mighty'),
                                'opening_business_time' => __('Closed', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#bb0f0f',
                                'time_color' => '#bb0f0f',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Sunday', 'mighty'),
                                'opening_business_time' => __('Closed', 'mighty'),
                                'enable_styling' => 'true',
                                'day_color' => '#FF0000',
                                'time_color' => '#FF0000',
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

            $this->add_control(
                'enable_schema',
                [
                    'label' => __( 'Enable openingHours Schema', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'On', 'mighty' ),
                    'label_off' => __( 'Off', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'false'
                ]
            );

            $this->add_control(
                'schema_type',
                [
                    'label' => __( 'Type', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        'CivicStructure'  => __( 'CivicStructure', 'mighty' ),
                        'LocalBusiness' => __( 'LocalBusiness', 'mighty' ),
                    ],
                    'default' => 'LocalBusiness',
                    'description' => '<b>CivicStructure</b>: A public structure, such as a town hall or concert hall.<br>
                    <b>LocalBusiness</b>:A particular physical business or branch of an organization. Site logo is required to be enabled',
                    'condition' => [
                        'enable_schema' => 'yes'
                    ]
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
                    'default' => 'solid',
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
                    'default' => '#E6E6E65C',
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
                    'default' => '#232323',
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
                    'default' => '#232323',
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
                    'default' => 'true',
                ]
            );

            $this->add_control(
                'odd_rows_bg_color',
                [
                    'label' => __( 'Odd Rows Background', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
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
                    'default' => '#FAFBFD',
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
                    'default' => '#6732B8',
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
                    'default' => [
                        'top' =>  '10',
                        'right' => '10',
                        'bottom' => '10',
                        'left' => '10',
                    ],
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
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '20',
                        'left' => '0',
                        'isLinked' => true,
                    ],
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
        $enableSchema = $settings['enable_schema'] == "yes" ? true : false;
        $schemaType = $settings['schema_type'];
        ?>

        <div class="ma-openinghours-wrapper" <?php echo $enableSchema ? ' itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/' . $schemaType . '"' : ''; ?>>
            <?php
            // Logo for LocalBusiness Schema
            if ( $enableSchema && $settings['schema_type'] == "LocalBusiness" ) :
                $logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' );
                if ( has_custom_logo() ) {
                    echo '<img style="display:none;" itemprop="image" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                }
            endif;
            ?>
            <div <?php echo $enableSchema ? 'itemprop="name"' : ''; ?> class="ma-oh-header"><?php echo $settings['header_text']; ?></div>

            <div class="ma-oh-rows">
                <?php foreach (  $settings['mt_openinghours_data'] as $item ) : 
                    $closingTime = $item['opening_business_time'] === "Closed" || $item['opening_business_time'] === "24 hours" ? false : true;
                    if ( $enableSchema ) {
                        $schemaDay = "";
                        switch( $item['business_day'] ) {
                            case 'All Days': $schemaDay = "Mo-Su";
                            break;
                            case 'Monday - Friday': $schemaDay = "Mo-Fr";
                            break;
                            case 'Saturday - Sunday': $schemaDay = "Sa-Su";
                            break;
                            default: $schemaDay = substr($item['business_day'], 0, 2);
                        }
                    }
                ?>
                <div class="ma-oh-row <?php echo ($settings['striped_effect'] == true) ? 'mt-striped' : ''; ?> elementor-repeater-item-<?php echo $item['_id']; ?>">
                    <div class="ma-oh-day">
                        <time <?php echo $enableSchema ? 'itemprop="openingHours" datetime="'. $schemaDay .'"' : ''; ?>><?php echo $item['business_day']; ?></time>
                    </div>

                    <div class="ma-oh-time" <?php echo $enableSchema ? 'itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/OpeningHoursSpecification"' : ''; ?>>
                        <?php if ( $item['opening_business_time'] === "24 hours" ) { ?>

                            <time <?php echo $enableSchema ? 'itemprop="opens" content="' . date("H:i", strtotime("12:00 AM")) . '"' : ''; ?>><?php echo $item['opening_business_time']; ?></time>

                            <?php if ( $enableSchema ) : ?>
                            <time itemprop="closes" content="<?php echo date("H:i", strtotime("12:00 PM")); ?>"></time>
                            <?php endif; ?>

                        <?php } else { ?>
                            <time <?php echo $enableSchema ? 'itemprop="opens" content="' . date("H:i", strtotime($item['opening_business_time'])) . '"' : ''; ?>><?php echo $item['opening_business_time']; ?></time>
                            
                            <?php if ( $closingTime ) : ?>
                                - <time <?php echo $enableSchema ? 'itemprop="closes" content="' . date("H:i", strtotime($item['closing_business_time'])) . '"' : ''; ?>><?php echo $item['closing_business_time']; ?></time>
                            <?php endif;
                        } ?>
                        
                    </div>

                </div>
                <?php endforeach; ?>
            </div>

            <div <?php echo $enableSchema ? 'itemprop="description"' : ''; ?> class="ma-oh-footer"><?php echo $settings['footer_text']; ?></div>

        </div>
        <?php
	}
	
	protected function _content_template() {
	}
}
