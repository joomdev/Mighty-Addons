<?php
namespace MightyAddons\Widgets;

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
	
		// wp_register_style( 'mighty-slickcss', MIGHTY_ADDONS_PLG_URL . 'assets/css/slick.min.css', false, MIGHTY_ADDONS_VERSION );
		// wp_register_style( 'mighty-slicktheme', MIGHTY_ADDONS_PLG_URL . 'assets/css/slick-theme.min.css', false, MIGHTY_ADDONS_VERSION );
		// wp_register_style( 'mt-testimonial', MIGHTY_ADDONS_PLG_URL . 'assets/css/testimonial.min.css', false, MIGHTY_ADDONS_VERSION );
		// wp_register_script( 'mighty-slickjs', MIGHTY_ADDONS_PLG_URL . 'assets/js/slick.min.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );
		// wp_register_script( 'mt-testimonial', MIGHTY_ADDONS_PLG_URL . 'assets/js/testimonial.js', [ 'mighty-slickjs', 'jquery' ], MIGHTY_ADDONS_VERSION, true );
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
		// return [ 'mighty-slickjs', 'mt-testimonial' ];
	}

	public function get_style_depends() {
		// return [ 'mighty-slicktheme', 'mighty-slickcss', 'mt-testimonial' ];
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
                    'title' => 'Select No, if you do not want to load the age checker popup in your editor.',
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
                'title',
                [
                    'label' => __('Title', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Age Verification',
                    'title' => 'Leave empty if dont want to add any title'
                ]
            );

            $this->add_control(
                'description',
                [
                    'label' => __( 'Description', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'default' => 'You must be 18 years old in order to visit this website.', 'mighty',
                    'title' => 'Leave empty if dont want to add any description',
                ]
            );

            $this->add_control(
                'check_input_box',
                [
                    'label' => __('Check Input Text', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXT,
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
                ]
            );

            $this->add_control(
                'button_text',
                [
                    'label' => __('Button Text', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label' => __('Button Icon', 'mighty'),
                    'type' => \Elementor\Controls_Manager::ICON,
                ]
            );

            $this->add_control(
                'icon_position',
                [
                    'label' => __('Icon Position', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => __('age_confirmation'),
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
                    'condition' => [
                        'method' => 'yes_no'
                    ]
                ]
            );

            $this->add_control(
                'second_button_icon',
                [
                    'label' => __('Button Icon', 'mighty'),
                    'type' => \Elementor\Controls_Manager::ICON,
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
                    'default' => __('age_confirmation'),
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
                ]
            );

            $this->add_control(
                'bottom_text',
                [
                    'label' => __( 'Bottom Text', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'title' => 'Leave empty if you dont want to add the bottom text.',
                ]
            );

            $this->add_control(
                'error_message',
                [
                    'label' => __( 'Error Message', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'title' => 'Leave empty if you dont want to add the bottom text.',
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
                ]
            );

            $this->add_control(
                'background_image',
                [
                    'label' => __( 'Background Image', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'condition' => [
                        'add_background_image' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'overlay_color',
                [
                    'label' => __( 'Overlay Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'add_right_side_image', [
                    'label' => __( 'Add Right Side Image', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
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
                'enable_cookies', [
                    'label' => __( 'Enable Cookies', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                ]
            );

            $this->add_control(
                'cookies_expiry_time',
                [
                    'label' => __('Cookies Expiry Time', 'mighty'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                ]
            );

        $this->end_controls_section();

        // style
        $this->start_controls_section(
			'section_agechecker_style',
			[
				'label' => __( 'Popup', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'display_position',
                [
                    'label' => __('Display Position', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => __('default'),
                    'options' => [
                        'top_left' => __('Top Left', 'mighty'),
                        'top_center' => __('Top Center', 'mighty'),
                        'top_right' => __('Top Right', 'mighty'),
                        'center_left' => __('Center Left', 'mighty'),
                        'center_center' => __('Center Center', 'mighty'),
                        'center_right' => __('Center Right', 'mighty'),
                        'bottom_left' => __('Bottom Left', 'mighty'),
                        'bottom_center' => __('Bottom Center', 'mighty'),
                        'bottom_right' => __('Bottom Right', 'mighty'),
                    ],
                ]
            );

            $this->add_responsive_control(
                'popup_width',
                [
                    'label' => __( 'Popup Width', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
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
                        '{{WRAPPER}} .mighty-chart' => 'width: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'popup_height',
                [
                    'label' => __( 'Popup Height', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
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
                        '{{WRAPPER}} .mighty-chart' => 'width: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

        $this->end_controls_section();

    }

}
	