<?php
namespace MightyAddons;

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
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'mt_enqueue_styles' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'mt_enqueue_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

	public function widget_styles() {
		wp_register_style('mighty-fontawesome', MIGHTY_ADDONS_PLG_URL . 'assets/css/fontawesome/css/all.min.css' );
		wp_register_style('mighty-slickcss', MIGHTY_ADDONS_PLG_URL . 'assets/css/slick.css' );
		wp_register_style('mt-testimonial', MIGHTY_ADDONS_PLG_URL . 'assets/css/testimonial.css' );
		wp_register_style('mt-team', MIGHTY_ADDONS_PLG_URL . 'assets/css/team.css' );
		wp_register_style('mt-progressbar', MIGHTY_ADDONS_PLG_URL . 'assets/css/progressbar.css' );
		wp_register_style('mt-counter', MIGHTY_ADDONS_PLG_URL . 'assets/css/counter.css' );
		wp_register_style('mt-buttongroup', MIGHTY_ADDONS_PLG_URL . 'assets/css/buttongroup.css' );
		wp_register_style('mt-accordion', MIGHTY_ADDONS_PLG_URL . 'assets/css/accordion.css' );
		wp_register_style('mt-twentytwenty', MIGHTY_ADDONS_PLG_URL . 'assets/css/twentytwenty.css' );
		wp_register_style('mt-beforeafter', MIGHTY_ADDONS_PLG_URL . 'assets/css/before-after.css' );
		wp_register_style('mt-gradientheading', MIGHTY_ADDONS_PLG_URL . 'assets/css/gradient-heading.css' );
	}

	public function mt_enqueue_styles() {
		wp_enqueue_style( 'mighty-fontawesome' );
		wp_enqueue_style( 'mighty-slickcss' );
		wp_enqueue_style( 'mt-testmonial' );
		wp_enqueue_style( 'mt-team' );
		wp_enqueue_style( 'mt-progressbar' );
		wp_enqueue_style( 'mt-counter' );
		wp_enqueue_style( 'mt-buttongroup' );
		wp_enqueue_style( 'mt-accordion' );
		wp_enqueue_style( 'mt-twentytwenty' );
		wp_enqueue_style( 'mt-beforeafter' );
		wp_enqueue_style( 'mt-gradientheading' );
	}

	public function widget_scripts() {
		wp_register_script( 'mighty-slickjs', MIGHTY_ADDONS_PLG_URL . 'assets/js/slick.js', [ 'jquery' ] );
		wp_register_script( 'mt-eventmovejs', MIGHTY_ADDONS_PLG_URL . 'assets/js/event.move.js', [ 'jquery' ] );
		wp_register_script( 'mt-twentytwentyjs', MIGHTY_ADDONS_PLG_URL . 'assets/js/twentytwenty.js', [ 'jquery' ] );
		
		wp_register_script( 'mt-testimonial', MIGHTY_ADDONS_PLG_URL . 'assets/js/testimonial.js', [ 'jquery' ], false, true );

		wp_register_script( 'mt-counter', MIGHTY_ADDONS_PLG_URL . 'assets/js/counter.js', [ 'jquery' ], false, true );

		wp_register_script( 'mt-accordion', MIGHTY_ADDONS_PLG_URL . 'assets/js/accordion.js', [ 'jquery' ], false, true );

		wp_register_script( 'mt-beforeafter', MIGHTY_ADDONS_PLG_URL . 'assets/js/beforeafter.js', [ 'jquery' ], false, true );
	}

	// enqueue frontend scripts
	public function mt_enqueue_scripts() {
		wp_enqueue_script( 'mt-testimonial' );
		wp_enqueue_script( 'mighty-slickjs' );
		wp_enqueue_script( 'mt-eventmovejs' );
		wp_enqueue_script( 'mt-twentytwentyjs' );
	}
	
	private function include_widgets_files() {
		require_once( realpath(__DIR__ . '/..') . '/widgets/testimonial.php' );
		require_once( realpath(__DIR__ . '/..') . '/widgets/team.php' );
		require_once( realpath(__DIR__ . '/..') . '/widgets/progressbar.php' );
		require_once( realpath(__DIR__ . '/..') . '/widgets/counter.php' );
		require_once( realpath(__DIR__ . '/..') . '/widgets/buttongroup.php' );
		require_once( realpath(__DIR__ . '/..') . '/widgets/accordion.php' );
		require_once( realpath(__DIR__ . '/..') . '/widgets/before-after.php' );
		require_once( realpath(__DIR__ . '/..') . '/widgets/gradient-heading.php' );
	}
	
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MT_Testimonial() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MT_Team() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MT_Progressbar() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MT_Counter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MT_ButtonGroup() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MT_Accordion() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MT_BeforeAfter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MT_GradientHeading() );
	}
}

// Instantiate Mighty_Elementor Class
Mighty_Elementor::instance();
