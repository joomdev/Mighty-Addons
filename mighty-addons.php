<?php
/**
 * Plugin Name: Mighty Addons
 * Description: <a href="https://mightythemes.com/products/mighty-addons/">Mighty Addons</a> is a Powerful Elementor Widget Plugin that comes with advanced & flexible features powering up your Elementor website and increasing your designing experience.
 * Plugin URI: https://mightythemes.com/products/mighty-addons/
 * Version:     1.7.4
 * Author:      MightyThemes
 * Author URI:  https://mightythemes.com/
 * Text Domain: mighty
 * Elementor tested up to: 3.5.5
 * Elementor Pro tested up to: 3.6.0
 */

namespace Mighty_Addons;

use MightyAddons\Classes\DashboardPanel;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'MIGHTY_ADDONS_VERSION', '1.7.4' );
define( 'MIGHTY_ADDONS_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'MIGHTY_ADDONS_PLG_URL', plugin_dir_url( __FILE__ ) );
define( 'MIGHTY_ADDONS_PLG_BASENAME', plugin_basename( __FILE__ ) );

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
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.9.0';

	/**
	 * Elementor Compatibility Version
	 *
	 * @since 1.3.13
	 * @var string Used for running some features based on Elemnetor old API until v2.9.14
	 */
	const ELEMENTOR_COMPATIBILITY_VERSION = '3.0.0';

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

		register_activation_hook( __FILE__, array( $this, 'mighty_addons_activation_redirect' ) );

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );

		add_action( 'admin_init', array( $this, 'show_user_what_we_got' ) );
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
	 * Activate Mighty Addons.
	 *
	 * Set Mighty-Addons activation hook.
	 *
	 * Fired by `register_activation_hook` when the plugin is activated.
	 *
	 * @since 2.0.0
	 * @access public
	 */
	public function mighty_addons_activation_redirect() {
		add_option('activate_mighty_addons', true);
	}

	public function show_user_what_we_got() {

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		} elseif ( get_option('activate_mighty_addons', false) ) {
			
			delete_option('activate_mighty_addons');
			if(!isset($_GET['activate-multi']))
			{
				wp_safe_redirect( admin_url( 'admin.php?page=mighty-addons-home' ) );
			}
		}
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

		// Check for required Compatible Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::ELEMENTOR_COMPATIBILITY_VERSION, '>=' ) ) {
			define( 'ELEMENTOR_OLD_COMPATIBLITY', true );
		} else {
			define( 'ELEMENTOR_OLD_COMPATIBLITY', false );
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Say hello to my little friend - Helper
		require_once ( MIGHTY_ADDONS_DIR_PATH . 'classes/class-helper-functions.php' );

		// From the depths, a magical window has opened including our plugin!
		require_once ( MIGHTY_ADDONS_DIR_PATH . 'classes/mighty-elementor.php' );

		// MA Extensions Tab for Elementor Editor Panel
		\Elementor\Controls_Manager::add_tab( 'map', __( 'Extensions', 'mighty' ) );

		// When in doubt go to the library - J.K. Rowling
		$this->loadLibrary();
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
			esc_html__( '%1$s requires %2$s to be installed and activated.', 'mighty' ),
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
			esc_html__( '%1$s requires %2$s version %3$s or greater.', 'mighty' ),
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
			esc_html__( '%1$s requires %2$s version %3$s or greater.', 'mighty' ),
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
	 * MightyLibrary
	 *
	 * Library for Mighty Templates
	 *
	 * @since 2.1.0
	 * @access public
	 */
	public function loadLibrary() {
		// Including stuff for Library
		require_once ( MIGHTY_ADDONS_DIR_PATH . 'library/inc/class-base.php' );
		require_once ( MIGHTY_ADDONS_DIR_PATH . 'library/inc/class-elementor.php' );
	}
}

// Instantiate Mighty_Addons.
new Mighty_Addons();
