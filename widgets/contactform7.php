<?php
namespace MightyAddons\Widgets;

use \MightyAddons\Classes\HelperFunctions as Helper;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_ContactForm7
 *
 * Elementor widget for MT_ContactForm7.
 *
 * @since 1.3.1
 */
class MT_ContactForm7 extends Widget_Base {
	
	public function get_name() {
		return 'mt-contactform7';
	}
	
	public function get_title() {
		return __( 'MT Contact Form 7', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-contactform7';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_style_depends() {
		return [ 'mt-common', 'mt-contactform7' ];
    }
	
	protected function _register_controls() {

        $this->start_controls_section(
			'section_contactform7',
			[
				'label' => __( 'MT Contact Form 7', 'mighty' ),
			]
        );

            if ( ! Helper::isCf7Active() ) {
                
                $this->add_control(
                    'cf7_inactive_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => __( '<p>You need to install and activate <b>Contact Form 7</b> to use the element.</p><br><p>1. Get <a target="_blank" rel="noopener" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a>.</p><br><p>2. Install and Activate the plugin.</b>.</p><br><p>3. Voila! Start styling your forms.</p>', 'mighty' ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
                );
                $this->end_controls_section();
                return;
            }
        
            $this->add_control(
                'cf7_form_id',
                [
                    'label' => __( 'Select Form', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => Helper::cf7FormsList(),
                ]
            );

            $this->add_control(
                'show_title',
                [
                    'label' => __( 'Show Title', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'cf7_title',
                [
                    'label' => __( 'Title', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __( 'Type your title here', 'mighty' ),
                    'condition' => [
                        'show_title' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'show_description',
                [
                    'label' => __( 'Show Description', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'cf7_description',
                [
                    'label' => __( 'Description', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 5,
                    'placeholder' => __( 'Type your description here', 'mighty' ),
                    'condition' => [
                        'show_description' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'hide_placeholders',
                [
                    'label' => __( 'Hide Placeholders', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Hide', 'mighty' ),
                    'label_off' => __( 'Show', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => '',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_contactform7_messages',
			[
				'label' => __( 'Messages', 'mighty' ),
			]
        );

            $this->add_control(
                'hide_success_msg',
                [
                    'label' => __( 'Hide Success Message', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Hide', 'mighty' ),
                    'label_off' => __( 'Show', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => '',
                ]
            );

            $this->add_control(
                'hide_error_msg',
                [
                    'label' => __( 'Hide Error Message', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Hide', 'mighty' ),
                    'label_off' => __( 'Show', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => '',
                ]
            );

            $this->add_control(
                'hide_validation_msg',
                [
                    'label' => __( 'Hide Validation Message', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Hide', 'mighty' ),
                    'label_off' => __( 'Show', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => '',
                ]
            );

            $this->add_control(
                'custom_classes',
                [
                    'label' => __( 'Custom Classes', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __( 'Type CSS Classes here', 'mighty' )
                ]
            );

            $this->add_control(
                'custom_id',
                [
                    'label' => __( 'Custom ID', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __( 'Type CSS ID here', 'mighty' )
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cf7_form_style',
            [
                'label' => __( 'Form', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'background',
                    'label' => __( 'Background', 'mighty' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .mighty-cf7-wrapper',
                ]
            );

            $this->add_responsive_control(
                'form_alignment',
                [
                    'label' => __( 'Form Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'align-left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'align-center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'align-right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => is_rtl() ? 'align-left' : 'align-right',
                    'toggle' => false,
                    'label_block' => false,
                ]
            );

            $this->add_responsive_control(
                'form_max_width',
                [
                    'label' => __( 'Width', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 5000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '100',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-cf7-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_margin',
                [
                    'label' => __( 'Margin', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-cf7-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-cf7-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'form_border',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mighty-cf7-wrapper',
                ]
            );

            $this->add_responsive_control(
                'form_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-cf7-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'form_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mighty-cf7-wrapper',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cf7_text_style',
            [
                'label' => __( 'Title & Description', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'text_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'align-details-left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'align-details-center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'align-details-right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'fa fa-align-right',
                        ],
                        'align-details-justify' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'fa fa-align-justify',
                        ]
                    ],
                    'default' => is_rtl() ? 'align-details-left' : 'align-details-right',
                    'toggle' => false,
                    'label_block' => false,
                ]
            );

            $this->start_controls_tabs(
                'text_styling_tabs'
            );
                // Title Styling
                $this->start_controls_tab(
                    'style_form_title',
                    [
                        'label' => __( 'Title', 'mighty' ),
                    ]
                );
                
                    $this->add_control(
                        'title_color',
                        [
                            'label'     => __( 'Color', 'mighty' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-cf7-title' => 'color: {{VALUES}}'
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .mighty-cf7-title',
                        ]
                    );

                $this->end_controls_tab();
                
                // Description styling
                $this->start_controls_tab(
                    'style_form_description',
                    [
                        'label' => __( 'Description', 'mighty' ),
                    ]
                );

                    $this->add_control(
                        'description_color',
                        [
                            'label'     => __( 'Color', 'mighty' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-cf7-description' => 'color: {{VALUES}}'
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'description_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .mighty-cf7-description',
                        ]
                    );

                $this->end_controls_tab();
            
            $this->end_controls_tabs();

        $this->end_controls_section();
        
        // Form Fields
        $this->start_controls_section(
            'section_form_fields_style',
            [
                'label' => __( 'Form Fields', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'field_width',
                [
                    'label' => __( 'Field Width', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_control(
                'spacing_fields',
                [
                    'label' => __( 'Spacing Between Fields', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'fields_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs(
                'fields_styling_tabs'
            );
                // Normal Styling
                $this->start_controls_tab(
                    'style_form_fields_normal',
                    [
                        'label' => __( 'Normal', 'mighty' ),
                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'field_background_color',
                            'label' => __( 'Background Color', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ',
                        ]
                    );

                    $this->add_control(
                        'field_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
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

                $this->end_controls_tab();
                
                // Focus styling
                $this->start_controls_tab(
                    'style_form_fields_focus',
                    [
                        'label' => __( 'Focus', 'mighty' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'field_focus_background_color',
                            'label' => __( 'Background Color', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ',
                        ]
                    );

                    $this->add_control(
                        'field_color_focus',
                        [
                            'label' => __( 'Color', 'mighty' ),
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
                            'name' => 'field_focus_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} ',
                        ]
                    );

                $this->end_controls_tab();
            
            $this->end_controls_tabs();

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'fields_border',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} ',
                ]
            );

            $this->add_responsive_control(
                'fields_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'fields_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} ',
                ]
            );

        $this->end_controls_section();

        // Placeholder
        $this->start_controls_section(
            'section_form_placeholder',
            [
                'label' => __( 'Placeholder', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'placholder_text_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'placeholder_text_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} ',
                ]
            );

        $this->end_controls_section();

        // Labels
        $this->start_controls_section(
            'section_form_labels',
            [
                'label' => __( 'Labels', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'label_text_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'label_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} ',
                ]
            );

            $this->add_responsive_control(
                'label_text_spacing',
                [
                    'label' => __( 'Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'margin: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Radio & Checkboxes
        $this->start_controls_section(
            'section_form_radio_checkbox',
            [
                'label' => __( 'Radio & Checkboxes', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'custom_style_controls',
                [
                    'label' => __( 'Custom Style', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_responsive_control(
                'controls_size',
                [
                    'label' => __( 'Width', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'condition' => [
                        'custom_style_controls' => 'yes'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .box' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs(
                'custom_style_controls_tabs'
            );
                // Normal Styling
                $this->start_controls_tab(
                    'style_controls_normal',
                    [
                        'label' => __( 'Normal', 'mighty' ),
                        'condition' => [
                            'custom_style_controls' => 'yes'
                        ]
                    ]
                );

                    $this->add_control(
                        'custom_control_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'custom_style_controls' => 'yes'
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'custom_control_border',
                            'label' => __( 'Border', 'mighty' ),
                            'selector' => '{{WRAPPER}} .wrapper',
                            'condition' => [
                                'custom_style_controls' => 'yes'
                            ]
                        ]
                    );

                    $this->add_control(
                        'custom_checkbox_title',
                        [
                            'label' => __( 'Checkbox', 'mighty' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before',
                            'condition' => [
                                'custom_style_controls' => 'yes'
                            ]
                        ]
                    );

                    $this->add_responsive_control(
                        'custom_checkbox_border_radius',
                        [
                            'label' => __( 'Border Radius', 'mighty' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'custom_style_controls' => 'yes'
                            ]
                        ]
                    );

                    $this->add_control(
                        'custom_radio_title',
                        [
                            'label' => __( 'Radio Buttons', 'mighty' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before',
                            'condition' => [
                                'custom_style_controls' => 'yes'
                            ]
                        ]
                    );

                    $this->add_responsive_control(
                        'custom_radio_border_radius',
                        [
                            'label' => __( 'Border Radius', 'mighty' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'custom_style_controls' => 'yes'
                            ]
                        ]
                    );

                $this->end_controls_tab();
                
                // Checked styling
                $this->start_controls_tab(
                    'style_form_fields_checked',
                    [
                        'label' => __( 'Checked', 'mighty' ),
                        'condition' => [
                            'custom_style_controls' => 'yes'
                        ]
                    ]
                );

                $this->add_control(
                    'custom_checked_color',
                    [
                        'label' => __( 'Color', 'mighty' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => \Elementor\Scheme_Color::get_type(),
                            'value' => \Elementor\Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} ' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'custom_style_controls' => 'yes'
                        ]
                    ]
                );

                $this->end_controls_tab();
            
            $this->end_controls_tabs();

            $this->add_control(
                'controls_stacked_on',
                [
                    'label' => __( 'Stacked On', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        'desktop'  => __( 'Desktop', 'mighty' ),
                        'tablet' => __( 'Tablet', 'mighty' ),
                        'mobile' => __( 'Mobile', 'mighty' ),
                    ],
                    'condition' => [
                        'custom_style_controls' => 'yes'
                    ]
                ]
            );

        $this->end_controls_section();
        
        // List
        $this->start_controls_section(
            'section_form_list',
            [
                'label' => __( 'List', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'custom_style_list',
                [
                    'label' => __( 'Custom Style', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_responsive_control(
                'list_width',
                [
                    'label' => __( 'Width', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'condition' => [
                        'custom_style_list' => 'yes'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs(
                'custom_style_list_tabs'
            );
                // Normal Styling
                $this->start_controls_tab(
                    'style_list_normal',
                    [
                        'label' => __( 'Normal', 'mighty' ),
                        'condition' => [
                            'custom_style_list' => 'yes'
                        ]
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'list_background_color',
                            'label' => __( 'Background Color', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ',
                            'condition' => [
                                'custom_style_list' => 'yes'
                            ],
                        ]
                    );

                    $this->add_control(
                        'list_control_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'custom_style_list' => 'yes'
                            ]
                        ]
                    );

                    $this->add_responsive_control(
                        'custom_list_padding',
                        [
                            'label' => __( 'Padding', 'mighty' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'custom_style_list' => 'yes'
                            ]
                        ]
                    );

                $this->end_controls_tab();
                
                // Selected styling
                $this->start_controls_tab(
                    'style_form_fields_selected',
                    [
                        'label' => __( 'Selected', 'mighty' ),
                        'condition' => [
                            'custom_style_list' => 'yes'
                        ]
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'list_selected_background_color',
                            'label' => __( 'Background Color', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ',
                            'condition' => [
                                'custom_style_list' => 'yes'
                            ],
                        ]
                    );

                    $this->add_control(
                        'list_selected_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                $this->end_controls_tab();
            
            $this->end_controls_tabs();

        $this->end_controls_section();

        // Button
        $this->start_controls_section(
            'section_form_button',
            [
                'label' => __( 'Button', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'button_alignment',
                [
                    'label' => __( 'Button Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => is_rtl() ? 'left' : 'right',
                    'toggle' => false,
                    'label_block' => false,
                ]
            );

            $this->start_controls_tabs(
                'button_tabs'
            );

                // Normal Styling
                $this->start_controls_tab(
                    'style_buttons_normal',
                    [
                        'label' => __( 'Normal', 'mighty' )
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background_color',
                            'label' => __( 'Background', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ',
                        ]
                    );

                    $this->add_control(
                        'button_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'mighty' ),
                            'selector' => '{{WRAPPER}} '
                        ]
                    );

                    $this->add_control(
                        'button_title',
                        [
                            'label' => __( 'Checkbox', 'mighty' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before'
                        ]
                    );

                $this->end_controls_tab();

                // Hover styling
                $this->start_controls_tab(
                    'style_buttons_hover',
                    [
                        'label' => __( 'Hover', 'mighty' )
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background_color',
                            'label' => __( 'Background Color', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ',
                        ]
                    );

                    $this->add_control(
                        'button_hover_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_border_hover_color',
                        [
                            'label' => __( 'Border Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                $this->end_controls_tab();
            
            $this->end_controls_tabs();

            $this->add_control(
                'button_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'spacing_button',
                [
                    'label' => __( 'Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'margin: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .wrapper',
                ]
            );

        $this->end_controls_section();
        
        // Success Message
        $this->start_controls_section(
            'section_success_messages',
            [
                'label' => __( 'Success Message', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'success_msg_background_color',
                    'label' => __( 'Background Color', 'mighty' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} ',
                ]
            );

            $this->add_control(
                'success_msg_color',
                [
                    'label' => __( 'Color', 'mighty' ),
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
                    'name' => 'success_msg_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} ',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'success_msg_border',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .wrapper',
                ]
            );

            $this->add_responsive_control(
                'success_msg_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'success_msg_content_form',
                [
                    'label' => __( 'Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'margin: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Error & Validation Messages
        $this->start_controls_section(
            'section_error_validation_messages',
            [
                'label' => __( 'Error & Validation Messages', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'error_msges_title',
                [
                    'label' => __( 'Error Messages', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->start_controls_tabs(
                'error_msges_tabs'
            );

                // Normal Styling
                $this->start_controls_tab(
                    'error_alert_tab',
                    [
                        'label' => __( 'Alert', 'mighty' )
                    ]
                );

                    $this->add_control(
                        'alert_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'color: {{VALUE}}',
                            ]
                        ]
                    );


                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'alert_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} ',
                        ]
                    );

                    $this->add_control(
                        'alert_spacing',
                        [
                            'label' => __( 'Spacing', 'mighty' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 5,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => '%',
                                'size' => '',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'margin: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Fields styling
                $this->start_controls_tab(
                    'style_alert_fields',
                    [
                        'label' => __( 'Fields', 'mighty' )
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'error_fields_background_color',
                            'label' => __( 'Background Color', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ',
                        ]
                    );

                    $this->add_control(
                        'error_fields_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} ' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'error_fields_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} ',
                        ]
                    );


                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'error_fields_border',
                            'label' => __( 'Border', 'mighty' ),
                            'selector' => '{{WRAPPER}} .wrapper',
                        ]
                    );

                $this->end_controls_tab();
            
            $this->end_controls_tabs();

            // Validation Messages
            $this->add_control(
                'validation_msges_title',
                [
                    'label' => __( 'Validation Messages', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'validation_background_color',
                    'label' => __( 'Background Color', 'mighty' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} ',
                ]
            );

            $this->add_control(
                'validation_color',
                [
                    'label' => __( 'Color', 'mighty' ),
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
                    'name' => 'validation_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} ',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'validation_border',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .wrapper',
                ]
            );

            $this->add_responsive_control(
                'validation_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'validation_spacing',
                [
                    'label' => __( 'Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' => 'margin: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
	}
	
	protected function render() {

        if ( ! Helper::isCf7Active() ) {
            return;
        }
        
        $settings = $this->get_settings_for_display();
        $cf7forms = Helper::cf7FormsList();
        $hidePlaceholders = $settings['hide_placeholders'] == "yes" ? ' hide-placeholders' : '';

        $hideSuccessMsg = $settings['hide_success_msg'] == "yes" ? ' hide-success-msg' : '';
        $hideErrorMsg = $settings['hide_error_msg'] == "yes" ? ' hide-error-msg' : '';
        $hideValidationMsg = $settings['hide_validation_msg'] == "yes" ? ' hide-validation-msg' : '';

        if ( ! empty( $settings['cf7_form_id'] ) ) {
            echo "<div" . ($settings['custom_id'] !== "" ? ' id=' . $settings['custom_id'] : "") . " class='mighty-cf7-wrapper" . $hidePlaceholders . $hideSuccessMsg . $hideErrorMsg . $hideValidationMsg . " " . $settings['custom_classes'] . " " . $settings['form_alignment'] . "'>";

            echo "<div class='form-details " . $settings['text_alignment'] ."'>";
            if( $settings['show_title'] == "yes" ) {
                echo "<div class='mighty-cf7-title'>" . $settings['cf7_title'] . "</div>";
            }

            if( $settings['show_description'] == "yes" ) {
                echo "<div class='mighty-cf7-description'>" . $settings['cf7_description'] . "</div>";
            }
            echo "</div>";

            echo do_shortcode( '[contact-form-7 id="' . $settings['cf7_form_id'] . ' title="' . $cf7forms[$settings['cf7_form_id']] .'"]' );
            echo "</div>";
        }
	}
	
	protected function _content_template() {
	}
}