<?php
namespace MightyAddonsPro\Extensions\MT_WrapperLink;

// Elementor classes
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MT_WrapperLink {

    private static $_instance = null;

    public final function __construct() {

		// Enqueue scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		
		// Register controls
		add_action( 'elementor/element/after_section_end', [ $this, 'register_controls' ], 10, 3 );

		// Live Rendering
		add_action( 'elementor/frontend/widget/before_render', [ $this, '_before_render' ], 10, 1 );
		add_action( 'elementor/frontend/column/before_render', [ $this, '_before_render' ], 10, 1 );
		add_action( 'elementor/frontend/section/before_render', [ $this, '_before_render' ], 10, 1 );

	}

	public function enqueue_scripts() {
		
		wp_enqueue_script( 'mt-wrapperlinkjs', MIGHTY_ADDONS_PLG_URL . 'assets/js/wrapper-link.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );
	}
    
    public function register_controls( $element, $section_id ) {

        if ( '_section_responsive' !== $section_id ) {
			return;
        }
        
		$element->start_controls_section(
			'mighty_wrapper_link',
			[
				'tab'   => 'map',
				'label' => __( 'MA Wrapper Link', 'mighty' ),
			]
		);

			$element->add_control(
				'enable_wrapper_link',
				[
					'label' => __( 'Enable wrapper link?', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'render_type' => 'ui',
				]
			);

			$element->add_control(
				'wrapper_link',
				[
					'label' => __( 'URL', 'mighty' ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://example.com', 'mighty' ),
					'show_external' => true,
					'description' => __( 'Accepts both normal URL and hashed (#) URLs', 'mighty' ),
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					],
					'render_type' => 'ui',
					'condition' => [
						'enable_wrapper_link' => 'yes'
					]
				]
			);

		$element->end_controls_section();
        
	}

	public function _before_render( $element ) { // Live Preview

		$settings  = $element->get_settings();

		if ( 'yes' === $settings['enable_wrapper_link'] ) {

			$element->add_render_attribute( '_wrapper', 'class', 'mighty-wrapper-link' );

			if( filter_var( $settings['wrapper_link']['url'], FILTER_VALIDATE_URL ) ) {
				$element->add_render_attribute( '_wrapper', 'data-mt-wrapperlink', $settings['wrapper_link']['url'] );
				$element->add_render_attribute( '_wrapper', 'data-mt-wrapperlink-external', $settings['wrapper_link']['is_external'] );
			} else {
				$element->add_render_attribute( '_wrapper', 'data-mt-hashed-wrapperlink', $settings['wrapper_link']['url'] );
				$element->add_render_attribute( '_wrapper', 'data-mt-wrapperlink-external', $settings['wrapper_link']['is_external'] );
			}

		}
	}
    
    public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

MT_WrapperLink::instance();