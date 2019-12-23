<?php
/**
 * Mighty Library
 * 
 * Integrating Elementor core.
 *
 * @package MightyAddons
 * @since 1.2.1
 */

namespace Mighty_Addons;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Elementor registration for MightyAddons popup.
 *
 * @since 1.2.1
 */
class Elementor extends base {
    
	public function __construct() {
		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'enqueue_editor_scripts' ] );

	}

	/**
	 * Load styles and scripts for Elementor modal.
	 */
	public function enqueue_editor_scripts() {

		wp_enqueue_script( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'library/assets/js/elementor-modal.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );
		
		wp_enqueue_style( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'library/assets/css/elementor-modal.css', [], MIGHTY_ADDONS_VERSION );

		// die(MIGHTY_ADDONS_PLG_URL . 'library\assets\js\library\build\static\js\2.81bc84e8.chunk.js');

		wp_register_script( 'mighty-library-react', MIGHTY_ADDONS_PLG_URL . 'library/assets\js\library\build\static\js\2.81bc84e8.chunk.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );

		wp_enqueue_style( 'mighty-library-admin', MIGHTY_ADDONS_PLG_URL . 'library/assets\js\library\build\static\css\main.d1b05096.chunk.css', [], MIGHTY_ADDONS_VERSION );


	}
}

new Elementor();
