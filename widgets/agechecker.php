<?php
namespace MightyAddons\Widgets;

use MightyAddons\Classes\AgeChecker;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_agechecker
 *
 * Elementor widget for MT_agechecker.
 *
 * @since 1.0.0
 */
class MT_agechecker extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	
		wp_register_style( 'mighty-agecheckercss', MIGHTY_ADDONS_PLG_URL . 'assets/css/age-checker.css', false, MIGHTY_ADDONS_VERSION );
		
		wp_register_script( 'mighty-age-checkerjs', MIGHTY_ADDONS_PLG_URL . 'assets/js/age-checker.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );
	}
	
	public function get_name() {
		return 'mt-agechecker';
	}
	
	public function get_title() {
		return __( 'Age Checker', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-agechecker';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_keywords() {
		return [ 'mighty', 'agechecker', 'recommendation' ];
    }
	
	public function get_script_depends() {
		return [ 'mighty-age-checkerjs' ];
	}

	public function get_style_depends() {
		return [ 'mighty-agecheckercss' ];
	}

    protected function register_controls() {

        $this->start_controls_section(
			'section_agechecker_basic',
			[
				'label' => __( 'Basic', 'mighty' ),
			]
		);

            $this->add_control(
                'method',
                [
                    'label' => __('Method', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => __('age_confirmation'),
                    'options' => [
                        'age_confirmation' => __('Age Confirmation', 'mighty'),
                        'date_birth' => __('Date of Birth', 'mighty'),
                        'yes_no' => __('Yes/No', 'mighty'),
                    ],
                ]
            );

            $this->add_control(
                'load_popup_in_editor', [
                    'label' => __( 'Load Popup in Editor', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'description' => 'Select No, if you do not want to load the age checker popup in your editor.',
                ]
            );

            $this->add_control(
                'minimum_age_limit', [
                    'label' => __( 'Minimum Age Limit', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'default' => '18',
                    'condition' => [
                        'method' => 'date_birth'
                    ]
                ]
            );

        $this->end_controls_section();

        // start content
        $this->start_controls_section(
			'section_agechecker_content',
			[
				'label' => __( 'Content', 'mighty' ),
			]
		);

            $this->add_control(
                'display_logo', [
                    'label' => __( 'Display Logo', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'logo',
                [
                    'label' => __( 'Logo', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'condition' => [
                        'display_logo' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'enable_title', [
                    'label' => __( 'Enable Title', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'yes'
                ]
            );

            $this->add_control(
                'title',
                [
                    'label' => __('Title', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Age Verification',
                    'condition' => [
                        'enable_title' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'enable_description', [
                    'label' => __( 'Enable Description', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'yes'
                ]
            );

            $this->add_control(
                'description',
                [
                    'label' => __( 'Description', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'default' => 'You must be 18 years old in order to visit this website.', 'mighty',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'enable_description',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'method',
                                'operator' => '==',
                                'value' => 'age_confirmation'
                            ]
                        ]
                    ]
                ]
            );

            $this->add_control(
                'description_date_birth',
                [
                    'label' => __( 'Description', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'default' => 'you must be 18 years old to visit our website. Enter your birth date below, your age will be calculated automatically.', 'mighty',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'enable_description',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'method',
                                'operator' => '==',
                                'value' => 'date_birth'
                            ]
                        ]
                    ]
                ]
            );

            $this->add_control(
                'description_yes_no',
                [
                    'label' => __( 'Description', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'default' => 'you must be 18 years old to visit our website. Select your preference below.', 'mighty',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'enable_description',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'method',
                                'operator' => '==',
                                'value' => 'yes_no'
                            ]
                        ]
                    ]
                ]
            );

            $this->add_control(
                'check_input_box',
                [
                    'label' => __('Check Input Text', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => 'I confirm that i am 18 years old or over',
                    'condition' => [
                        'method' => 'age_confirmation'
                    ]
                ]
            );

            $this->add_responsive_control(
                'form_content_max_width',
                [
                    'label' => __('Form Content Max-width', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
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
                    'conditions' => [
                        'terms' => [
                            [
                                'name' => 'method',
                                'operator' => '!==',
                                'value' => 'age_confirmation',
                            ],
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_control(
                'button_text',
                [
                    'label' => __('Button Text', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'ENTER',
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label' => __('Button Icon', 'mighty'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-check',
                        'library' => 'solid',
                    ],
                ]
            );

            $this->add_control(
                'icon_position',
                [
                    'label' => __('Icon Position', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => __('before'),
                    'options' => [
                        'before' => __('Before', 'mighty'),
                        'after' => __('After', 'mighty'),
                    ],
                ]
            );

            $this->add_responsive_control(
                'space_icon_text',
                [
                    'label' => __('Space between Icon and text', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
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
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech .ma-agech__btn-primary.ma-agech__icon-before .ma-agech-btn__icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .ma-agech .ma-agech__btn-primary.ma-agech__icon-after .ma-agech-btn__icon' => 'margin-left: {{SIZE}}{{UNIT}}'
                    ],
                    
                ]
            );

            $this->add_control(
                'second_button_options',
                [
                    'label' => __( 'Second Button Options', 'plugin-name' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'method' => 'yes_no'
                    ]
                ]
            );

            $this->add_control(
                'second_button_text',
                [
                    'label' => __('Button Text', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'No',
                    'condition' => [
                        'method' => 'yes_no'
                    ],
                ]
            );

            $this->add_control(
                'second_button_icon',
                [
                    'label' => __('Button Icon', 'mighty'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-skull-crossbones',
                        'library' => 'solid',
                    ],                    
                    'condition' => [
                        'method' => 'yes_no'
                    ]
                ]
            );

            $this->add_control(
                'second_icon_position',
                [
                    'label' => __('Icon Position', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => __('before'),
                    'options' => [
                        'before' => __('Before', 'mighty'),
                        'after' => __('After', 'mighty'),
                    ],
                    'condition' => [
                        'method' => 'yes_no'
                    ]
                ]
            );

            $this->add_responsive_control(
                'second_space_icon_text',
                [
                    'label' => __('Space between Icon and text', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
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
                    'condition' => [
                        'method' => 'yes_no'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech .ma-agech__btn-secondary.ma-agech__icon-before .ma-agech-btn__icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .ma-agech .ma-agech__btn-secondary.ma-agech__icon-after .ma-agech-btn__icon' => 'margin-left: {{SIZE}}{{UNIT}}'
                    ],
                ]
            );

            $this->add_control(
                'bottom_text',
                [
                    'label' => __( 'Bottom Text', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'default' => 'By entering this site you are agreeing to the Terms of Use and Privacy Policy',
                    'description' => 'Leave empty if you dont want to add the bottom text.',
                ]
            );

            $this->add_control(
                'error_message',
                [
                    'label' => __( 'Error Message', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'default' => 'Sorry...!!! You are not eligible for this website',
                    'conditions' => [
                        'terms' => [
                            [
                                'name' => 'method',
                                'operator' => '!==',
                                'value' => 'age_confirmation',
                            ],
                        ],
                    ],
                ]
            );

            $this->add_control(
                'content_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
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
                'bottom_line_alignment',
                [
                    'label' => __( 'Bottom Line Alginment', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Start', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'End', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                ]
            );

        $this->end_controls_section();

        // Extra
        $this->start_controls_section(
			'section_agechecker_extra',
			[
				'label' => __( 'Extra', 'mighty' ),
			]
		);

            $this->add_control(
                'add_background_image', [
                    'label' => __( 'Add Background Image', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'no'

                ]
            );

            $this->add_control(
                'background_image',
                [
                    'label' => __( 'Background Image', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'condition' => [
                        'add_background_image' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'background_image_position',
                [
                    'label' => __('Background Image Positon', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => __('default'),
                    'options' => [
                        'default' => __('Default', 'mighty'),
                        'top left' => __('Top Left', 'mighty'),
                        'top center' => __('Top Center', 'mighty'),
                        'top right' => __('Top Right', 'mighty'),
                        'center left' => __('Center Left', 'mighty'),
                        'center center' => __('Center Center', 'mighty'),
                        'center right' => __('Center Right', 'mighty'),
                        'bottom left' => __('Bottom Left', 'mighty'),
                        'bottom center' => __('Bottom Center', 'mighty'),
                        'bottom right' => __('Bottom Right', 'mighty'),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech' => 'background-position: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'overlay_color',
                [
                    'label' => __( 'Overlay Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .has-overlay' => 'background: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'add_right_side_image', [
                    'label' => __( 'Add Right Side Image', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'right_side_background_image',
                [
                    'label' => __( 'Image', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'condition' => [
                        'add_right_side_image' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'image_position',
                [
                    'label' => __('Image Positon', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => __('top left'),
                    'options' => [
                        'top left' => __('Default', 'mighty'),
                        'top center' => __('Top Center', 'mighty'),
                        'top right' => __('Top Right', 'mighty'),
                        'center left' => __('Center Left', 'mighty'),
                        'center center' => __('Center Center', 'mighty'),
                        'center right' => __('Center Right', 'mighty'),
                        'bottom left' => __('Bottom Left', 'mighty'),
                        'bottom center' => __('Bottom Center', 'mighty'),
                        'bottom right' => __('Bottom Right', 'mighty'),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__wrapper .ma-agech__side-image' => 'background-position: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'enable_cookies', [
                    'label' => __( 'Enable Cookies', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'cookies_expiry_time',
                [
                    'label' => __('Cookies Expiry Time', 'mighty'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'default' => '1',
                    'condition' => [
                        'enable_cookies' => 'yes'
                    ],
                    'description' => 'Set the number of days cookies to be stored.'
                ]
            );

        $this->end_controls_section();

        // style
        $this->start_controls_section(
			'section_agechecker_style',
			[
				'label' => __( 'Popup', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'display_position',
                [
                    'label' => __('Display Position', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => __('default'),
                    'options' => [
                        'default' => __('Default', 'mighty'),
                        'top-left' => __('Top Left', 'mighty'),
                        'top-center' => __('Top Center', 'mighty'),
                        'top-right' => __('Top Right', 'mighty'),
                        'center-left' => __('Center Left', 'mighty'),
                        'center-center' => __('Center Center', 'mighty'),
                        'center-right' => __('Center Right', 'mighty'),
                        'bottom-left' => __('Bottom Left', 'mighty'),
                        'bottom-center' => __('Bottom Center', 'mighty'),
                        'bottom-right' => __('Bottom Right', 'mighty'),
                    ],
                ]
            );

            $this->add_responsive_control(
                'popup_width',
                [
                    'label' => __( 'Popup Width', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px'],
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
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'popup_height',
                [
                    'label' => __( 'Popup Height', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px'],
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
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_type',
                    'label' => __( 'Background Type', 'mighty' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ma-agech__wrapper',
                ]
		    );

            $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'popup_border',
					'label' => __( 'Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .ma-agech__wrapper',
				]
			);

            $this->add_responsive_control(
				'popup_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'popup_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .ma-agech__wrapper',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_agechecker_logo_style',
			[
				'label' => __( 'Logo', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'display_logo' => 'yes'
                ]
			]
        );

            $this->add_responsive_control(
                'logo_size',
                [
                    'label' => __( 'Logo Size', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 600
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__logo' => 'max-width: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
				'logo_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__logo-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'logo_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__logo-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_agechecker_title_style',
			[
				'label' => __( 'Title', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_title' => 'yes'
                ]
			]
        );

            $this->add_control(
                'title_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ma-agech__title',
				]
			);

            $this->add_responsive_control(
				'title_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'title_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_agechecker_description_style',
			[
				'label' => __( 'Description', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_description' => 'yes'
                ]
			]
        );

            $this->add_control(
                'description_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__description' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'description_typography',
					'selector' => '{{WRAPPER}} .ma-agech__description',
				]
			);

            $this->add_responsive_control(
				'description_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'description_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_agechecker_checkbox_style',
			[
				'label' => __( 'Checkbox', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'method' => 'age_confirmation'
                ]
			]
        );

            $this->add_control(
                'checkbox_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__checkbox-label' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'checkbox_typography',
					'selector' => '{{WRAPPER}} .ma-agech__checkbox-label',
				]
			);

            $this->add_responsive_control(
				'checkbox_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__checkbox-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'checkbox_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__checkbox-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_agechecker_input_field_style',
			[
				'label' => __( 'Input Field', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'method' => 'date_birth'
                ]
			]
        );

            $this->add_control(
                'input_field_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__input' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_control(
                'input_field_background_color',
                [
                    'label'     => __( 'Background Color', 'mighty' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__input' => 'background-color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'input_field_typography',
					'selector' => '{{WRAPPER}} .ma-agech__input',
				]
			);

            $this->add_responsive_control(
				'input_field_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'input_field_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'input_field_border',
					'label' => __( 'Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .ma-agech__input',
				]
			);

            $this->add_responsive_control(
				'input_field_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'input_field_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .ma-agech__input',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_agechecker_button_style',
			[
				'label' => __( 'Button', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->start_controls_tabs(
                'button_tabs'
            );
            // start normal tab
                $this->start_controls_tab(
                    'button_normal',
                    [
                        'label' => __('Normal', 'mighty'),
                    ]
                );

                    $this->add_control(
                        'button_text_color',
                        [
                            'label'     => __( 'Text Color', 'mighty' ),
                            'type'      => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ma-agech__btn-primary' => 'color: {{VALUES}}'
                            ]
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background_type',
                            'label' => __( 'Background Type', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                        ]
                    );

                $this->end_controls_tab();
                // end normal tab
                // start hover tab
                $this->start_controls_tab(
                    'button_hover',
                    [
                        'label' => __('Hover', 'mighty'),
                    ]
                );

                    $this->add_control(
                        'button_hover_text_color',
                        [
                            'label'     => __( 'Text Color', 'mighty' ),
                            'type'      => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ma-agech__btn-primary:hover' => 'color: {{VALUES}}'
                            ]
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background_type',
                            'label' => __( 'Background Type', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ma-agech__btn-primary:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => __( 'Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
				]
			);

            $this->add_responsive_control(
				'button_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__btn-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_responsive_control(
				'button_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__btn-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'button_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__btn-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_agechecker_second_button_style',
			[
				'label' => __( 'Second Button', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'method' => 'yes_no'
                ]
			]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'second_button_typography',
                    'selector' => '{{WRAPPER}} .ma-agech__btn-secondary',
                ]
            );

            $this->start_controls_tabs(
                'second_button_tabs'
            );
            // start normal tab
                $this->start_controls_tab(
                    'second_button_normal',
                    [
                        'label' => __('Normal', 'mighty'),
                    ]
                );

                    $this->add_control(
                        'second_button_text_color',
                        [
                            'label'     => __( 'Text Color', 'mighty' ),
                            'type'      => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ma-agech__btn-secondary' => 'color: {{VALUES}}'
                            ]
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'second_button_background_type',
                            'label' => __( 'Background Type', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ma-agech__btn-secondary',
                        ]
                    );

                $this->end_controls_tab();
                // end normal tab
                // start hover tab
                $this->start_controls_tab(
                    'second_button_hover',
                    [
                        'label' => __('Hover', 'mighty'),
                    ]
                );

                    $this->add_control(
                        'second_button_hover_text_color',
                        [
                            'label'     => __( 'Text Color', 'mighty' ),
                            'type'      => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ma-agech__btn-secondary:hover' => 'color: {{VALUES}}'
                            ]
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'second_button_hover_background_type',
                            'label' => __( 'Background Type', 'mighty' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ma-agech__btn-secondary:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tab();

            $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'second_button_border',
					'label' => __( 'Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .ma-agech__btn-secondary',
				]
			);

            $this->add_responsive_control(
				'second_button_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__btn-secondary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'second_button_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .ma-agech__btn-secondary',
                ]
            );

            $this->add_responsive_control(
				'second_button_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__btn-secondary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'second_button_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__btn-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_agechecker_bottom_text_style',
			[
				'label' => __( 'Bottom Text', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'bottom_text_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__bottom-text' => 'color: {{VALUE}}'
                    ]
                ]
            );

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'bottom_text_typography',
					'selector' => '{{WRAPPER}} .ma-agech__bottom-text',
				]
			);

            $this->add_responsive_control(
				'bottom_text_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__bottom-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'bottom_text_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__bottom-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_agechecker_error_msg_style',
			[
				'label' => __( 'Error Message', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'method',
                            'operator' => '!==',
                            'value' => 'age_confirmation',
                        ],
                    ],
                ],
			]
        );

            $this->add_control(
                'error_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ma-agech__age-alert' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'error_background_type',
                    'label' => __( 'Background Type', 'mighty' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ma-agech__age-alert',
                ]
            );

            $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'error_border',
					'label' => __( 'Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .ma-agech__age-alert',
				]
			);

            $this->add_responsive_control(
				'error_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__age-alert' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'error_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .ma-agech__age-alert',
                ]
            );

            $this->add_responsive_control(
				'error_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__age-alert' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'error_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .ma-agech__age-alert' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'age-checker', 'class', 'ma-agech' );
        $this->add_render_attribute( 'right-side-image', 'class', 'ma-agech__wrapper' );
        $this->add_render_attribute( 'right-side-image', 'class', $settings['display_position'] );
        $this->add_render_attribute( 'first-button', 'class', 'ma-agech__btn-primary' );
        
        $cookie_time =  ( $settings['enable_cookies'] == 'yes' ) ? $settings['cookies_expiry_time'] : '';
        $this->add_render_attribute( 'age-checker', 'data-cookie_time', $cookie_time );
        $this->add_render_attribute( 'age-checker', 'data-id', $this->get_id() );
        

        if ( $settings[ 'display_logo' ] == 'yes' ) {
            $logo = $settings[ 'logo' ][ 'id' ] ? $settings[ 'logo' ][ 'url' ] : '';
        }

        if ( $settings[ 'add_background_image' ] == 'yes' ) {
            $background_image = $settings[ 'background_image' ][ 'id' ] ? $settings[ 'background_image' ][ 'url' ] : '';
        } else {
            $background_image = '';
        }

        if ( $settings[ 'right_side_background_image' ] ) {
            $right_side_background_image = $settings[ 'right_side_background_image' ]['id'] ? $settings[ 'right_side_background_image' ]['url'] : '';
        }

        $title = ( $settings[ 'enable_title' ] == 'yes' ) ? $settings[ 'title' ] : '';

        if ( $settings[ 'enable_description' ] == 'yes' ) {

            if ( $settings[ 'method' ] == 'age_confirmation' ) {
                $description = $settings[ 'description' ];
            }
            if ( $settings[ 'method' ] == 'yes_no' ) {
                $description = $settings[ 'description_yes_no' ];
            }
            if ( $settings[ 'method' ] == 'date_birth' ) {
                $description = $settings[ 'description_date_birth' ];
            }

            if ( $settings['overlay_color'] ) {
                $this->add_render_attribute( 'age-checker', 'class', 'has-overlay' );
            }

            if ( $settings['add_right_side_image'] == 'yes' ) {
                $this->add_render_attribute( 'right-side-image', 'class', 'ma-right-side-image' );
            }

            $this->add_render_attribute( 'first-button', 'class', 'ma-agech__icon-'. $settings['icon_position'] .' ' );
            if ( $settings['method'] != 'yes_no' ) {
                $this->add_render_attribute( 'first-button', 'class', 'button-disable' );
            }

        }
       
    ?>
    
    <?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && $settings['load_popup_in_editor'] != 'yes' ) { ?>

        <p class="widget_info" > Note: You may use this widget on Header or Footer Template directly. It will load it on all pages throughout the website. </p>

    <?php } else { ?>

        <?php if ( ( !array_key_exists('applicable-for-site'.$this->get_id(), $_COOKIE ) ) && !isset( $_COOKIE['applicable-for-site'.$this->get_id()] ) ) { ?>

            <div <?php echo $this->get_render_attribute_string('age-checker'); ?>  style='background-image: url( <?php echo $background_image ;?> ); background-position : <?php echo $settings['background_image_position'];?>' >

                <div <?php echo $this->get_render_attribute_string('right-side-image'); ?> >

                <div class="ma-agech__content-wrapper">

                    <?php if ( !empty ( $settings['error_message'] ) ) { ?>
                        <div class="ma-agech__age-alert"><?php echo ( isset( $settings['error_message'] ) ) ? $settings['error_message'] : '';?></div>
                    <?php } ?>

                    <div class="ma-agech__content">

                        <div class="ma-agech__content-inner ma-align-<?php echo $settings['content_alignment'];?>">

                            <?php if ( isset( $logo ) && !empty ( $logo ) ) { ?>
                                <div class="ma-agech__logo-wrapper">
                                    <img src="<?php echo $logo ;?>" alt="logo" class="ma-agech__logo">
                                </div>
                            <?php } ?>    

                            <?php if ( isset ( $title ) ) { ?>
                                <h3 class="ma-agech__title"><?php echo $title ?></h3>
                            <?php } ?>    

                            <?php if ( isset ( $description ) && !empty ( $description ) ) { ?>
                                <div class="ma-agech__description"><?php echo $description; ?></div>
                            <?php } ?>

                            <?php if ( $settings['method'] == 'age_confirmation' ) { ?>
                                <div class="ma-agech__checkbox-wrapper">
                                    <input type="checkbox" id="age18plus" class="ma-agech__checkbox" name="age" >
                                    <label for="vehicle1" class="ma-agech__checkbox-label"><?php echo $settings['check_input_box'];?></label>
                                </div>
                            <?php } ?>

                            <div class="ma-agech__input-btn-wrapper">
                                <?php if ( $settings['method'] == 'date_birth' ) { ?>
                                    <div class="ma-agech__input-wrapper">
                                        <input type="date" data-min_age = "<?php echo ( isset($settings['minimum_age_limit'] ) ) ? $settings['minimum_age_limit'] : '' ?>"  value="" id="birthdate" class="ma-agech__input" name="birthdate">
                                    </div>
                                <?php } ?>

                                <div class="ma-agech__btn-wrapper">

                                    <a href="#" onclick="enterInSite()" <?php echo $this->get_render_attribute_string('first-button'); ?> role="btn">
                                        <span class="ma-agech-btn__icon"><i class="<?php echo $settings['button_icon']['value']; ?>"></i></span>
                                        <span class="ma-agech-btn__text" ><?php echo $settings['button_text']; ?></span>
                                    </a>

                                    <?php if( $settings['method'] == 'yes_no' ) { ?>
                                        <a href="#" onclick="notAllowed()" class="ma-agech__btn-secondary ma-agech__icon-<?php echo $settings['second_icon_position']; ?>" role="btn">
                                            <span class="ma-agech-btn__icon"><i class="<?php echo $settings['second_button_icon']['value']; ?>"></i></span>
                                            <span class="ma-agech-btn__text"><?php echo $settings['second_button_text'];?></span>
                                        </a>
                                    <?php } ?>

                                </div>

                            </div>

                        </div>

                        <?php if ( !empty( $settings['bottom_text'] ) ) { ?>
                            <div class="ma-agech__bottom-text ma-align-<?php echo $settings['bottom_line_alignment'];?>"><?php echo $settings['bottom_text']; ?></div>
                        <?php } ?>

                    </div>

                </div>

                    <?php if ( $settings['add_right_side_image'] == 'yes' && !empty ( $right_side_background_image ) ) { ?>
                        <div class="ma-agech__side-image" style='background-image: url( <?php echo $right_side_background_image ;?> )' ></div>
                    <?php } ?>

                </div>

            </div>
        <?php } ?> 

    <?php } ?>

    <?php 

    }

}
	