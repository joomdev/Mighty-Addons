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

        $this->end_controls_section();

    }

}
	