<?php
namespace MightyAddons;

use \MightyAddons\Classes\HelperFunctions;

/**
 * Class Mighty_Elementor
 * 
 * @since 1.0.0
 */
class Mighty_Elementor {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {

		// Register Widget Styles
		add_action( 'wp_enqueue_scripts', [ $this, 'mt_enqueue_styles' ] );

		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'mt_enqueue_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

	public static function enqueue_editor_scripts() {
        wp_enqueue_style(
            'mighty-icons',
            MIGHTY_ADDONS_PLG_URL . 'assets/css/mighty-icons.css',
            null,
            MIGHTY_ADDONS_VERSION
		);
	}

	public function mt_enqueue_styles() {
		wp_enqueue_style('mighty-slickcss', MIGHTY_ADDONS_PLG_URL . 'assets/css/slick.min.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mighty-slicktheme', MIGHTY_ADDONS_PLG_URL . 'assets/css/slick-theme.min.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-testimonial', MIGHTY_ADDONS_PLG_URL . 'assets/css/testimonial.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-team', MIGHTY_ADDONS_PLG_URL . 'assets/css/team.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-progressbar', MIGHTY_ADDONS_PLG_URL . 'assets/css/progressbar.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-counter', MIGHTY_ADDONS_PLG_URL . 'assets/css/counter.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-buttongroup', MIGHTY_ADDONS_PLG_URL . 'assets/css/buttongroup.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-accordion', MIGHTY_ADDONS_PLG_URL . 'assets/css/accordion.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-twentytwenty', MIGHTY_ADDONS_PLG_URL . 'assets/css/twentytwenty.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-beforeafter', MIGHTY_ADDONS_PLG_URL . 'assets/css/before-after.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-gradientheading', MIGHTY_ADDONS_PLG_URL . 'assets/css/gradient-heading.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-flipbox', MIGHTY_ADDONS_PLG_URL . 'assets/css/flip-box.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-openinghours', MIGHTY_ADDONS_PLG_URL . 'assets/css/opening-hours.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-cf7styler', MIGHTY_ADDONS_PLG_URL . 'assets/css/cf7-styler.css', false, MIGHTY_ADDONS_VERSION );
		wp_enqueue_style('mt-mailchimp', MIGHTY_ADDONS_PLG_URL . 'assets/css/mailchimp.css', false, MIGHTY_ADDONS_VERSION );
		// Common Stylings
		wp_enqueue_style('mt-common', MIGHTY_ADDONS_PLG_URL . 'assets/css/common.css', false, MIGHTY_ADDONS_VERSION );
	}

	public function widget_scripts() {
		wp_register_script( 'mighty-slickjs', MIGHTY_ADDONS_PLG_URL . 'assets/js/slick.min.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );
		wp_register_script( 'mt-eventmovejs', MIGHTY_ADDONS_PLG_URL . 'assets/js/event.move.min.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );
		wp_register_script( 'mt-twentytwentyjs', MIGHTY_ADDONS_PLG_URL . 'assets/js/twentytwenty.min.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );
		
		wp_register_script( 'mt-testimonial', MIGHTY_ADDONS_PLG_URL . 'assets/js/testimonial.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );

		wp_register_script( 'mt-counter', MIGHTY_ADDONS_PLG_URL . 'assets/js/counter.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );

		wp_register_script( 'mt-accordion', MIGHTY_ADDONS_PLG_URL . 'assets/js/accordion.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );

		wp_register_script( 'mt-beforeafter', MIGHTY_ADDONS_PLG_URL . 'assets/js/beforeafter.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );
	}

	// enqueue frontend scripts
	public function mt_enqueue_scripts() {
		wp_enqueue_script( 'mt-testimonial' );
		wp_enqueue_script( 'mighty-slickjs' );
		wp_enqueue_script( 'mt-eventmovejs' );
		wp_enqueue_script( 'mt-twentytwentyjs' );
	}
	
	public function register_widgets() {

		$widgets = HelperFunctions::mighty_addons()['addons'];
		$extensions = HelperFunctions::mighty_addons()['extensions'];
		
		foreach( $widgets as $widget => $props ) {
			if( $props['enable'] ) {
				
				// Including Plugin
				require_once( MIGHTY_ADDONS_DIR_PATH . 'widgets/' . $widget .'.php' );
				
				// Register Widgets
				$class = sprintf( 'MightyAddons\Widgets\%s', $props['class'] );
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class );
			}
		}
	}
}

// Instantiate Mighty_Elementor Class
Mighty_Elementor::instance();
