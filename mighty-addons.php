<?php
/**
 * Plugin Name: Mighty Addons
 * Description: Addons for elementor by MightyThemes.
 * Plugin URI: https://mightythemes.com/products/mighty-addons/
 * Version:     1.1.0
 * Author:      MightyThemes1
 * Author URI:  https://mightythemes.com/
 * Text Domain: mighty
 */

namespace Mighty_Addons;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'MIGHTY_VERSION', '1.0.1' );
define( 'MIGHTY_ADDONS_PLG_URL', plugins_url( '/', __FILE__ ) );

/**
 * Main Mighty Addons Class
 *
 * The init class that runs the Mighty Addons plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.0.0
 */
final class Mighty_Addons {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'mighty' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {
		
		// Register Custom Controls
		add_action( 'elementor/controls/controls_registered', [$this, 'register_controls'] );

		// Register Custom Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'classes/mighty-elementor.php' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'mighty' ),
			'<strong>' . esc_html__( 'Mighty Addons', 'mighty' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mighty' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mighty' ),
			'<strong>' . esc_html__( 'Mighty Addons', 'mighty' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mighty' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mighty' ),
			'<strong>' . esc_html__( 'Mighty Addons', 'mighty' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'mighty' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
     * Register custom controls
     *
     * Include custom controls file and register them
     *
     * @since 1.1.0
     *
     * @access public
     */
    public function register_controls() {
        require( 'controls/gradient.php' );
        $gradient = __NAMESPACE__ . '\Controls\Group_Control_Text_Gradient';

        \Elementor\Plugin::instance()->controls_manager->add_group_control( $gradient::get_type(), new $gradient() );
    }

	/**
	 * Plugin Category
	 *
	 * Creating category for Mighty Addons
	 *
	 * @since 1.0.0
	 * @access public
	 */
	function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'mighty-addons',
			[
				'title' => __( 'Mighty Addons', 'mighty' ),
				'icon' => 'fas fa-ghost',
			]
		);
	}
}

// Instantiate Mighty_Addons.
new Mighty_Addons();
