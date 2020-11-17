<?php

namespace MightyAddons\Extensions\MT_Customcss;

// Elementor classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\DynamicTags\Dynamic_CSS;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MT_Customcss {

    private static $_instance = null;

    public final function __construct() {
		
		// Register controls
		add_action( 'elementor/element/after_section_end', [ $this, 'register_controls' ], 10, 3 );
		
		add_action( 'elementor/element/parse_css', [ $this, 'add_custom_css' ], 10, 2 );

		// Enqueuing Styles and Scripts
		add_action( 'elementor/element/after_section_end', [ $this, 'enqueue_scripts' ] );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( 'mt-customcssjs', MIGHTY_ADDONS_PLG_URL . 'assets/js/custom-css.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );

	}
    
    public function register_controls( $element, $section_id ) {

		if ( '_section_responsive' !== $section_id ) {
			return;
        }
        
		$element->start_controls_section(
			'mighty_custom_css',
			[
                'tab'   => 'map',
				'label' => __( 'MA Custom CSS', 'mighty' ),
			]
        );
        
			$element->add_control(
				'ma_custom_css',
				[
					'label' => __( 'Custom CSS', 'mighty' ),
					'type' => \Elementor\Controls_Manager::CODE,
					'language' => 'css',
					'rows' => 30,
					'render_type' => 'ui',
				]
			);

			$element->add_control(
				'ma_custom_css_help',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => __( '<p><b>How to?</b></p><br>
					<p>• Apply on <b>Element\'s Wrapper</b></p><br>
					<kbd> selector {<br> &nbsp;&nbsp;&nbsp;&nbsp;background-color: red; <br>} </kbd>
					<br><br>
					<p>• Apply on <b>Child Element</b>.</p><br>
					<kbd> selector .child-class {<br> &nbsp;&nbsp;&nbsp;&nbsp;background-color: red; <br>} </kbd>
					<br><br>
					<p>• Use on Custom Selector you defined in <b>Advanced > CSS ID | CSS Classes</b> </p><br>
					<kbd> .custom-class {<br> &nbsp;&nbsp;&nbsp;&nbsp;background-color: red; <br>} </kbd>', 'mighty' )
				]
			);

        $element->end_controls_section();
        
	}

	public function add_custom_css( $post_css, $element ) {

		if ( $post_css instanceof Dynamic_CSS ) {
			return;
		}

		$settings = $element->get_settings_for_display();

		if ( empty( $settings['ma_custom_css'] ) ) {
			return;
		}
		
		$customCss = trim( $settings['ma_custom_css'] );

		$customCss = str_replace( 'selector', $post_css->get_element_unique_selector( $element ), $customCss );

		// Queueing CSS
		$post_css->get_stylesheet()->add_raw_css( $customCss );
	}
    
    public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

MT_Customcss::instance();